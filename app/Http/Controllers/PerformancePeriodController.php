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
    #ini untuk menghapus periode
   public function destroy(PerformancePeriod $period)
{
    $period->delete();

    return redirect()->route('admin.performance.periods.index')
                     ->with('success', 'Periode berhasil dihapus');
}



    // 🔹 Menampilkan form buat periode
    public function create()
    {
        return view('admin.performance.periods.create');
    }

    // 🔹 Menyimpan data periode baru
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
}
