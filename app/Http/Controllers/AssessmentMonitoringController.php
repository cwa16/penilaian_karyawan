<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentMonitoringController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data untuk opsi Filter (Dropdown)
        $depts = DB::table('users')
            ->whereNotNull('dept')
            ->distinct()
            ->pluck('dept');

        // Ambil list tahun dari tabel performance_periods untuk dropdown
        $years = DB::table('performance_periods')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 2. Mulai Query Utama
        $query = DB::table('performance_assessments as pa')
            ->join('users as emp', 'pa.user_nik', '=', 'emp.nik')
        // JOIN BARU: Hubungkan ke tabel periods
            ->join('performance_periods as pp', 'pa.period_id', '=', 'pp.id');

        // 3. Filter Logic
        if ($request->filled('dept')) {
            $query->where('emp.dept', $request->dept);
        }

        // FILTER BARU: Menggunakan kolom 'year' dari tabel 'performance_periods'
        if ($request->filled('tahun')) {
            $query->where('pp.year', $request->tahun);
        }

        // 4. Select Data (Subquery Penilai tetap sama)
        $data = $query->select(
            'pa.id',
            'emp.nik',
            'emp.name',
            'emp.dept',
            'emp.jabatan',
            'pp.name as period_name', // Opsional: Ambil nama periode (misal: "Semester 1")
            'pp.year',                // Opsional: Ambil tahun

            // Subquery Penilai 1
            DB::raw("(SELECT u.name
                      FROM performance_scores ps
                      JOIN users u ON ps.evaluator_nik = u.nik
                      WHERE ps.assessment_id = pa.id AND ps.evaluator_order = 1
                      LIMIT 1) as p1_name"),
            DB::raw("(SELECT CASE WHEN COUNT(*) > 0 THEN 'OK' ELSE '-' END
                      FROM performance_scores ps
                      WHERE ps.assessment_id = pa.id AND ps.evaluator_order = 1
                      LIMIT 1) as p1_ket"),

            // Subquery Penilai 2
            DB::raw("(SELECT u.name
                      FROM performance_scores ps
                      JOIN users u ON ps.evaluator_nik = u.nik
                      WHERE ps.assessment_id = pa.id AND ps.evaluator_order = 2
                      LIMIT 1) as p2_name"),
            DB::raw("(SELECT CASE WHEN COUNT(*) > 0 THEN 'OK' ELSE '-' END
                      FROM performance_scores ps
                      WHERE ps.assessment_id = pa.id AND ps.evaluator_order = 2
                      LIMIT 1) as p2_ket")
        )
            ->orderBy('emp.name', 'asc')
            ->paginate(10);

        return view('admin.monitoring.index', compact('data', 'depts', 'years'));
    }
}
