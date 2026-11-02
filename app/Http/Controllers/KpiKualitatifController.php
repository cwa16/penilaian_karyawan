<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiKualitatif;
use App\Imports\KpiKualitatifImport;
use Maatwebsite\Excel\Facades\Excel;

class KpiKualitatifController extends Controller
{
    // TAMPILKAN DATA
    public function index()
    {
        $kualitatifs = KpiKualitatif::latest()->get();
        return view('kpi-kualitatif.index', compact('kualitatifs'));
    }

    // IMPORT DATA
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new KpiKualitatifImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data KPI Kualitatif berhasil diimport!');
    }
}