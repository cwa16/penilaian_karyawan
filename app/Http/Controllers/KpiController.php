<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiScore;

class KpiController extends Controller
{
    public function index()
    {
        $kpis = KpiScore::latest()->get();
        return view('kpi.index', compact('kpis'));
    }
    
    public function show($id)
    {
        $kpi = \App\Models\KpiScore::findOrFail($id);
        return view('kpi.show', compact('kpi'));
    }

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('file');

    if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {

        $header = true;

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

            // skip header
            if ($header) {
                $header = false;
                continue;
            }

            KpiScore::create([
                'tahun' => $row[0] ?? null,
                'nik' => $row[1] ?? null,
                'nama' => $row[2] ?? null,
                'dept' => $row[3] ?? null,
                'jabatan' => $row[4] ?? null,
                'posisi' => $row[5] ?? null,
                'total_kpi' => $row[6] ?? null,
            ]);
        }

        fclose($handle);
    }

    return back()->with('success', 'Data berhasil diimport');
}
}
