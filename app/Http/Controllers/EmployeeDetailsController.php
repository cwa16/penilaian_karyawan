<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmployeeDetailsController extends Controller
{
    // Tampilkan daftar karyawan (index)
    public function index(Request $request)
    {
        $login = Auth::user();

        // Jika belum login, redirect ke halaman login
        if (!$login) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $query = User::query();
        
        if ($login->status != 'Manager') {
            $query->where('dept_code', $login->dept_code);
        }

        // Ambil filter dari request
        $status = $request->get('status');
        $dept = $request->get('dept');
        $jabatan = $request->get('jabatan');
        $search = $request->get('search');

        $employees = $query->get();

        if ($status) $query->where('status', $status);
        if ($dept) $query->where('dept', $dept);
        if ($jabatan) $query->where('jabatan', $jabatan);
        if ($search) $query->where('name', 'like', '%'.$search.'%');

        $employees = $query->orderBy('name')->paginate(15);

        // Ambil data unik untuk dropdown filter
        $allStatus = User::select('status')->distinct()->pluck('status');
        $allDept = User::select('dept')->distinct()->pluck('dept');
        $allJabatan = User::select('jabatan')->distinct()->pluck('jabatan');

        return view('admin.employee-details.index', compact(
            'employees', 'status', 'dept', 'jabatan', 'search',
            'allStatus', 'allDept', 'allJabatan'
        ));
    }

    // Tampilkan detail karyawan + histori penilaian (detail)
    public function detail($employeeId)
    {
        // Ambil data employee
        $employee = User::findOrFail($employeeId);

        // Ambil histori penilaian (bisa kosong)
        $assessments = DB::table('performance_assessments as pa')
            ->join('performance_periods as p', 'p.id', '=', 'pa.period_id')
            ->where('pa.user_nik', $employee->nik)
            ->select('pa.id as assessment_id', 'p.year')
            ->orderByDesc('p.year')
            ->get();

        // Ambil semua skor jika ada
        $scores = DB::table('performance_scores')
            ->whereIn('assessment_id', $assessments->pluck('assessment_id'))
            ->get()
            ->groupBy(['assessment_id', 'criteria_id']);

        $criteria = DB::table('performance_criteria')->orderBy('id')->get();

        $histories = [];

        foreach ($assessments as $a) {
            $total = 0;

            foreach ($criteria as $c) {
                $scoreCollection = $scores[$a->assessment_id][$c->id] ?? collect();

                $nilai1 = optional($scoreCollection->firstWhere('evaluator_order', 1))->score ?? 0;
                $nilai2 = optional($scoreCollection->firstWhere('evaluator_order', 2))->score ?? 0;

                $values = collect([$nilai1, $nilai2])->filter(fn($v) => $v > 0);
                $avg = $values->count() ? $values->avg() : 0;

                $skor = ($avg * $c->weight) / 100;
                $total += $skor;
            }

            $persenQualitatif = ($total / 5) * 100;
            $hasilQualitatif  = ($persenQualitatif * 40) / 100;

            $histories[] = [
                'year'             => $a->year,
                'dept'             => $employee->dept,
                'position'         => $employee->jabatan,
                'persen'           => round($persenQualitatif, 0),
                'hasil_qualitatif' => round($hasilQualitatif, 0),
            ];
        }

        return view('admin.employee-details.detail', [
            'employee'  => $employee,
            'histories' => $histories
        ]);
    }
}