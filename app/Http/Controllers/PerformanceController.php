<?php
namespace App\Http\Controllers;

use App\Models\PerformanceAssessment;
use App\Models\PerformanceCriteria;
use App\Models\PerformancePeriod;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function form($periodId, $userId)
    {
        $user     = User::where('nik', $userId)->firstOrFail();
        $criteria = PerformanceCriteria::orderBy('id')->get();

        $assignSlot = Auth::user();

        if ($assignSlot->status == 'Manager') {
            $evaluatorOrder = 2;
        } else {
            $evaluatorOrder = 1;
        }

        $assessment = PerformanceAssessment::firstOrCreate([
            'user_nik'  => $userId,
            'period_id' => $periodId,
        ], [
            'status' => 'draft',
        ]);

        $scores = DB::table('performance_scores')
            ->where('assessment_id', $assessment->id)
            ->get()
            ->groupBy('criteria_id')
            ->map(function ($items) {
                return $items->pluck('score', 'evaluator_order');
            });

        return view('admin.performance.form', compact(
            'user', 'criteria', 'assessment', 'scores', 'evaluatorOrder'
        ));
    }

    public function save(Request $request)
    {

        $assessment = PerformanceAssessment::findOrFail($request->assessment_id);
        $user       = User::where('nik', $assessment->user_nik)->firstOrFail();
        $cekSlot    = Auth::user();

        $evaluatorOrder = ($cekSlot->status == 'Manager') ? 2 : 1;

        foreach ($request->scores as $criteriaId => $evaluators) {
            foreach ($evaluators as $order => $score) {

                // BLOK evaluator curang
                if ($order != $evaluatorOrder) {
                    continue;
                }

                DB::table('performance_scores')->updateOrInsert(
                    [
                        'assessment_id'   => $assessment->id,
                        'criteria_id'     => $criteriaId,
                        'evaluator_order' => $evaluatorOrder,
                        'evaluator_nik' => $cekSlot->nik,
                    ],
                    [
                        'score'      => $score,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }

        return back()->with('success', 'Penilaian berhasil disimpan');
    }

    public function employeesByPeriod($periodId)
    {
        // Validasi period (WAJIB ADA)
        $period    = PerformancePeriod::findOrFail($periodId);
        $evaluator = Auth::user();

        if ($evaluator->status == 'Manager') {
            $deptCode = $evaluator->dept_code;

            switch ($deptCode) {
                case 'Director':
                    $employees = User::whereIn('dept', ['Security', 'FSD', 'FAD', 'Factory', 'Workshop'])
                        ->whereNotIn('status', ['Regular', 'Contract FL'])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;

                case 'Acc & Fin':
                    $employees = User::whereIn('dept', ['Acc & Fin',
                    ])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;

                case 'HRGA':
                    $employees = User::whereIn('dept', ['HR Legal', 'IT', 'HSE & DP'])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;

                case 'Div 1':
                    $employees = User::whereIn('dept', ['I/A', 'I/B', 'I/C'])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;

                case 'Div 1':
                    $employees = User::whereIn('dept', ['II/D', 'II/E', 'II/F'])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;

                case 'SPID':
                    $employees = User::whereIn('dept', ['SPID'])
                        ->orderBy('name')
                        ->get();
                    $evaluatorOrder = 2;
                    break;
            }

        } else {
            $employees = User::whereIn('status', ['Monthly', 'Contract BSKP', 'Regular'])
                ->where('dept_code', $evaluator->dept_code)
                ->orderBy('name')
                ->get();

            $evaluatorOrder = 1;
        }

        $rows = $employees->map(function ($emp) use ($periodId) {

            $assessment = PerformanceAssessment::where([
                'user_nik'  => $emp->nik,
                'period_id' => $periodId,
            ])->first(); // boleh null

            return [
                'nik'        => $emp->nik,
                'name'       => $emp->name,
                'dept'       => $emp->dept,
                'status'     => $emp->status,
                'jabatan'    => $emp->jabatan,
                'pendidikan' => $emp->pendidikan,
                'status'     => $emp->status,
                'assessment' => $assessment,
            ];
        });

        return view('admin.performance.periods.select-employee', compact('period', 'rows', 'evaluatorOrder')
        );
    }
}
