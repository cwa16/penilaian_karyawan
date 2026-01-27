<?php
namespace App\Http\Controllers;

use App\Models\PerformanceAssessment;
use App\Models\PerformanceCriteria;
use App\Models\PerformancePeriod;
use App\Models\PerformanceScore;
use App\Models\User;
use App\Services\AssessmentEvaluatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function form($periodId, $userId, AssessmentEvaluatorService $evaluatorService)
    {
        $user     = User::where('nik', $userId)->firstOrFail();
        $criteria = PerformanceCriteria::orderBy('id')->get();

        $slot = $evaluatorService->validateEvaluatorForSlot(Auth::user(), $user);

        $assessment = PerformanceAssessment::firstOrCreate([
            'user_nik'  => $userId,
            'period_id' => $periodId,
        ], [
            'status' => 'draft',
        ]);

        $scores = PerformanceScore::where('assessment_id', $assessment->id)
            ->where('evaluator_nik', Auth::user()->nik)
            ->pluck('score', 'criteria_id');

        return view('admin.performance.form', compact(
            'user', 'criteria', 'assessment', 'scores', 'slot'
        ));
    }

    public function save(Request $request, AssessmentEvaluatorService $evaluatorService)
    {

        $assessment = PerformanceAssessment::findOrFail($request->assessment_id);
        $user       = User::where('nik', $assessment->user_nik)->firstOrFail();
        $slot       = $evaluatorService->validateEvaluatorForSlot(Auth::user(), $user);
        foreach ($request->scores as $criteriaId => $score) {
            PerformanceScore::updateOrCreate(
                [
                    'assessment_id' => $request->assessment_id,
                    'criteria_id'   => $criteriaId,
                    'evaluator_nik' => Auth::user()->nik,
                    'slot'          => $slot,
                ],
                [
                    'score' => $score,
                ]
            );
        }

        return back()->with('success', 'Penilaian berhasil disimpan');
    }

    public function employeesByPeriod($periodId, AssessmentEvaluatorService $evaluatorService)
    {
        // Validasi period (WAJIB ADA)
        $period    = PerformancePeriod::findOrFail($periodId);
        $evaluator = auth()->user();

        $employees = User::whereNotNull('status')
            ->whereNotNull('dept')
            ->orderBy('name')
            ->get()
            ->filter(fn($emp) =>
                $evaluatorService->canSeeEmployee($evaluator, $emp)
            );

        $rows = $employees->map(function ($emp) use ($periodId, $evaluatorService) {

            [$penilai1, $penilai2] = $evaluatorService->getExpectedEvaluators($emp);

            $assessment            = PerformanceAssessment::where([
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
                'penilai1'   => $penilai1,
                'penilai2'   => $penilai2,
                'assessment' => $assessment,
            ];
        });

        return view('admin.performance.periods.select-employee', compact('period', 'rows')
        );
    }
}
