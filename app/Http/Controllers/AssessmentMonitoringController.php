<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentMonitoringController extends Controller
{
    public function index(Request $request)
    {
        // ============================
        // FILTER INPUT
        // ============================
        $dept   = $request->dept;
        $period = $request->period;
        $tahun  = $request->tahun;

        // ============================
        // DROPDOWN DATA
        // ============================

        // Dept
        $departments = DB::table('users')
            ->whereNotNull('dept')
            ->distinct()
            ->orderBy('dept')
            ->pluck('dept');

        // alias (dipakai di blade kedua)
        $depts = $departments;

        // Period
        $periods = DB::table('performance_periods')
            ->orderBy('year', 'desc')
            ->get();

        // Years
        $years = DB::table('performance_periods')
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // ============================
        // QUERY MONITORING (TABLE ATAS)
        // ============================

        $assessments = DB::table('performance_assessments as pa')
            ->join('users as emp', 'pa.user_nik', '=', 'emp.nik')
            ->leftJoin('users as a1', 'pa.assessor1_id', '=', 'a1.id')
            ->leftJoin('users as a2', 'pa.assessor2_id', '=', 'a2.id')
            ->join('performance_periods as pp', 'pa.period_id', '=', 'pp.id')

            ->select(
                'pa.id',
                'emp.nik',
                'emp.name as employee_name',
                'emp.dept',
                'a1.name as assessor1_name',
                'pa.status_assessor1',
                'a2.name as assessor2_name',
                'pa.status_assessor2',
                'pp.year'
            )

            ->when($dept, fn ($q) => $q->where('emp.dept', $dept))
            ->when($period, fn ($q) => $q->where('pa.period_id', $period))

            ->orderBy('pp.year', 'desc')
            ->get();

        // ============================
        // QUERY MONITORING (TABLE BAWAH)
        // ============================

        $query = DB::table('performance_assessments as pa')
            ->join('users as emp', 'pa.user_nik', '=', 'emp.nik')
            ->join('performance_periods as pp', 'pa.period_id', '=', 'pp.id');

        if ($dept) {
            $query->where('emp.dept', $dept);
        }

        if ($tahun) {
            $query->where('pp.year', $tahun);
        }

        $data = $query->select(
            'pa.id',
            'emp.nik',
            'emp.name',
            'emp.dept',
            'emp.jabatan',
            'pp.name as period_name',
            'pp.year',

            DB::raw("(SELECT u.name
                FROM performance_scores ps
                JOIN users u ON ps.evaluator_nik = u.nik
                WHERE ps.assessment_id = pa.id
                AND ps.evaluator_order = 1
                LIMIT 1) as p1_name"),

            DB::raw("(SELECT CASE WHEN COUNT(*) > 0 THEN 'OK' ELSE '-' END
                FROM performance_scores ps
                WHERE ps.assessment_id = pa.id
                AND ps.evaluator_order = 1) as p1_ket"),

            DB::raw("(SELECT u.name
                FROM performance_scores ps
                JOIN users u ON ps.evaluator_nik = u.nik
                WHERE ps.assessment_id = pa.id
                AND ps.evaluator_order = 2
                LIMIT 1) as p2_name"),

            DB::raw("(SELECT CASE WHEN COUNT(*) > 0 THEN 'OK' ELSE '-' END
                FROM performance_scores ps
                WHERE ps.assessment_id = pa.id
                AND ps.evaluator_order = 2) as p2_ket")
        )
            ->orderBy('emp.name')
            ->paginate(10);

        // ============================
        // RETURN VIEW
        // ============================

        return view('admin.monitoring.index', compact(
            'assessments',
            'departments',
            'periods',
            'data',
            'depts',
            'years'
        ));
    }
}