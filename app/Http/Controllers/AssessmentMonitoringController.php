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

        // ============================
        // DROPDOWN FILTER DATA
        // ============================

        // Dept dari users
        $departments = DB::table('users')
            ->select('dept')
            ->whereNotNull('dept')
            ->distinct()
            ->orderBy('dept')
            ->pluck('dept');

        // Periode dari performance_periods
        $periods = DB::table('performance_periods')
            ->orderBy('year', 'desc')
            ->get();

        // ============================
        // QUERY MONITORING
        // ============================

        $assessments = DB::table('performance_assessments as pa')
            ->join('users as emp', 'pa.user_nik', '=', 'emp.nik')

            // assessor1
            ->leftJoin('users as a1', 'pa.assessor1_id', '=', 'a1.id')

            // assessor2
            ->leftJoin('users as a2', 'pa.assessor2_id', '=', 'a2.id')

            // periode
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

            // FILTER
            ->when($dept, function ($q) use ($dept) {
                return $q->where('emp.dept', $dept);
            })

            ->when($period, function ($q) use ($period) {
                return $q->where('pa.period_id', $period);
            })

            ->orderBy('pp.year', 'desc')
            ->get();

        // ============================
        // RETURN VIEW
        // ============================

        return view('admin.monitoring.index', compact(
            'assessments',
            'departments',
            'periods'
        ));
    }
}
