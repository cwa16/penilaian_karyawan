<?php
namespace App\Http\Controllers;

use App\Models\PerformancePeriod;

class PerformancePeriodController extends Controller
{
    public function index()
    {
        $periods = PerformancePeriod::orderBy('year', 'desc')->get();

        return view('admin.performance.periods.index', compact('periods'));
    }
}
