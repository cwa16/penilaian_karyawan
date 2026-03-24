<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiKualitatif;
use App\Imports\KpiKualitatifImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PerformancePeriod;
use Carbon\Carbon;

class KpiKualitatifController extends Controller
{
    // PILIH PERIODE
    public function periods()
    {
        $currentYear = Carbon::now()->year;
        $periods = PerformancePeriod::orderBy('year', 'desc')->get();
        foreach ($periods as $period) {
            $hasData = KpiKualitatif::where('period_id', $period->id)->exists();
            if ($period->year > $currentYear) {
                $period->status = 'Belum Dimulai';
                $period->canImport = false;
            } elseif ($period->year == $currentYear) {
                $period->status = 'Penilaian Sedang Berlangsung';
                $period->canImport = false;
            } else {
                if ($hasData) {
                    $period->status = 'Data KPI Telah Tersedia';
                    $period->canImport = false;
                } else {
                    $period->status = 'Tidak Ada Data KPI';
                    $period->canImport = true;
                }
            }
        }
        return view('kpi-kualitatif.periods', compact('periods'));
    }
    
    // TAMPILKAN DATA
    
    public function index($periodId)
    {
        $period = PerformancePeriod::findOrFail($periodId);
        $kualitatifs = KpiKualitatif::where('period_id', $periodId)->get();
        return view('kpi-kualitatif.index', [
            'kualitatifs' => $kualitatifs,
            'period' => $period
        ]);
    }

    // IMPORT DATA
    public function import(Request $request, $periodId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        KpiKualitatif::where('period_id', $periodId)->delete();

        Excel::import(new KpiKualitatifImport($periodId), $request->file('file'));

        return back()->with('success', 'Data KPI berhasil diimport');
    }
}