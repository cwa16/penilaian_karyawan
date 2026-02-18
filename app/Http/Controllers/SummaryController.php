<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Exports\PerformanceSummaryExcelExport;
use Maatwebsite\Excel\Excel;
use App\Models\Criteria;

class SummaryController extends Controller
{
    public function index($periodId)
    {    
        $period = DB::table('performance_periods')
            ->where('id', $periodId)
            ->first();

        $deptFilter = request('dept');

        $assessments = DB::table('performance_assessments as pa')
            ->join('users as u', 'u.nik', '=', 'pa.user_nik')
            ->where('pa.period_id', $period->id)
            ->when($deptFilter, function($q) use ($deptFilter) {
                $q->where('u.dept', $deptFilter);
            })    
            ->select(
                'pa.id as assessment_id',
                'u.nik',
                'u.name',
                'u.dept'
            )
            ->get();

        $scores = DB::table('performance_scores')
            ->whereIn('assessment_id', $assessments->pluck('assessment_id'))
            ->get()
            ->groupBy(['assessment_id', 'criteria_id']);

        $criteria = DB::table('performance_criteria')
            ->orderBy('id')
            ->get();

        $summary = [];

        foreach ($assessments as $a) {

            $total = 0;
            $rows  = [];

            foreach ($criteria as $c) {

                // ambil collection score per assessment + criteria
                $scoreCollection =
                $scores[$a->assessment_id][$c->id] ?? collect();

                $nilai1 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 1)
                )->score ?? 0;

                $nilai2 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 2)
                )->score ?? 0;

                $values = collect([$nilai1, $nilai2])->filter(fn($v) => $v > 0);

                $avg = $values->count() > 0
                    ? $values->avg()
                    : 0;


                $skor   = ($avg * $c->weight) / 100;
                $total += $skor;

                $rows[$c->id] = [
                    'nilai1' => $nilai1,
                    'nilai2' => $nilai2,
                    'avg'    => $avg,
                    'skor'   => round($skor, 2),
                ];
            }

            $summary[] = [
                'assessment_id' => $a->assessment_id,
                'nik'   => $a->nik,
                'name'  => $a->name,
                'dept'  => $a->dept, 
                'rows'  => $rows,
                'total' => round($total, 2),
            ];
        }
        $allDept = DB::table('users')
                ->select('dept')
                ->distinct()
                ->orderBy('dept')
                ->pluck('dept');

        return view('admin.performance.summary.index', compact('summary', 'criteria', 'period', 'allDept'));
    }


    public function exportExcel($periodId)
    {
        $period = DB::table('performance_periods')
            ->where('id', $periodId)
            ->first();

        $assessments = DB::table('performance_assessments as pa')
            ->join('users as u', 'u.nik', '=', 'pa.user_nik')
            ->where('pa.period_id', $period->id)
            ->select(
                'pa.id as assessment_id',
                'u.nik',
                'u.name',
                'u.dept'
            )
            ->get();

        $scores = DB::table('performance_scores')
            ->whereIn('assessment_id', $assessments->pluck('assessment_id'))
            ->get()
            ->groupBy(['assessment_id', 'criteria_id']);

        $criteria = DB::table('performance_criteria')
            ->orderBy('id')
            ->get();

        $summary = collect();

        foreach ($assessments as $a) {

            $total = 0;
            $rows  = [];

            foreach ($criteria as $c) {

                $scoreCollection =
                    $scores[$a->assessment_id][$c->id] ?? collect();

                $nilai1 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 1)
                )->score ?? 0;

                $nilai2 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 2)
                )->score ?? 0;

                $values = collect([$nilai1, $nilai2])->filter(fn($v) => $v > 0);
                $avg = $values->count() > 0
                    ? $values->avg()
                    : 0;

                $skor = ($avg * $c->weight) / 100;
                $total += $skor;

                $rows[$c->id] = [
                'nilai1' => $nilai1,
                'nilai2' => $nilai2,
                'skor'   => round($skor, 2),
                ];
            }

            $summary->push([
                'nik'   => $a->nik,
                'name'  => $a->name,
                'dept'  => $a->dept, 
                'rows'  => $rows,
                'total' => round($total, 2),
            ]);
        }
        return app(Excel::class)->download(
            new PerformanceSummaryExcelExport($summary, $criteria),
            'Ringkasan_Penilaian_'.$period->year.'.xlsx'
        );
    }

    // DETAIL
    public function detail($assessmentId)
    {
        $baseAssessment = DB::table('performance_assessments as pa')
            ->join('users as u', 'u.nik', '=', 'pa.user_nik')
            ->where('pa.id', $assessmentId)
            ->select(
                'u.nik',
                'u.name',
                'u.dept',
                'u.jabatan'
            )
            ->first();

        if (!$baseAssessment) {
            abort(404);
        }

        // ambil SEMUA assessment user ini (multi periode)
        $assessments = DB::table('performance_assessments as pa')
            ->join('performance_periods as p', 'p.id', '=', 'pa.period_id')
            ->where('pa.user_nik', $baseAssessment->nik)
            ->select(
                'pa.id as assessment_id',
                'p.year'
            )
            ->orderByDesc('p.year')
            ->get();

        // ambil semua skor
        $scores = DB::table('performance_scores')
            ->whereIn('assessment_id', $assessments->pluck('assessment_id'))
            ->get()
            ->groupBy(['assessment_id', 'criteria_id']);

        $criteria = DB::table('performance_criteria')
            ->orderBy('id')
            ->get();

        $histories = [];

        foreach ($assessments as $a) {

            $total = 0;

            foreach ($criteria as $c) {
                $scoreCollection =
                    $scores[$a->assessment_id][$c->id] ?? collect();

                $nilai1 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 1)
                )->score ?? 0;

                $nilai2 = optional(
                    $scoreCollection->firstWhere('evaluator_order', 2)
                )->score ?? 0;

                $values = collect([$nilai1, $nilai2])->filter(fn($v) => $v > 0);
                $avg = $values->count() ? $values->avg() : 0;

                $skor = ($avg * $c->weight) / 100;
                $total += $skor;
            }

            $persenQualitatif = ($total / 5) * 100;
            $hasilQualitatif  = ($persenQualitatif * 40) / 100;

            $histories[] = [
                'year'             => $a->year,
                'dept'             => $baseAssessment->dept,
                'position'         => $baseAssessment->jabatan,
                'persen'           => round($persenQualitatif, 0),
                'hasil_qualitatif' => round($hasilQualitatif, 0),
            ];
        }

        return view('admin.performance.summary.detail', [
            'employee'  => $baseAssessment,
            'histories' => $histories
        ]);
    }

}
