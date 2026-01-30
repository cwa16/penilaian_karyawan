<?php
namespace App\Http\Controllers;

use DB;

class SummaryController extends Controller
{
    public function index($periodId)
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
                'u.name'
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

                // rata-rata hanya dari yang terisi
                $avg = collect([$nilai1, $nilai2])
                    ->filter(fn($v) => $v > 0)
                    ->avg() ?? 0;

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
                'nik'   => $a->nik,
                'name'  => $a->name,
                'rows'  => $rows,
                'total' => round($total, 2),
            ];
        }

        return view('admin.performance.summary.index', compact('summary', 'criteria', 'period'));
    }
}
