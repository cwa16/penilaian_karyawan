<?php
namespace App\Http\Controllers;

use App\Models\PerformancePeriod;
use Illuminate\Http\Request;


class PerformancePeriodController extends Controller
{
    public function index()
    {
        $periods = PerformancePeriod::orderBy('year', 'desc')->get();

        return view('admin.performance.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.performance.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        PerformancePeriod::create([
            'year' => $request->year,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.performance.periods.index')
                        ->with('success', 'Periode berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $period = PerformancePeriod::findOrFail($id);
        $period->delete();

        return redirect()->route('admin.performance.periods.index')
            ->with('success', 'Periode berhasil dihapus!');
    }

}
