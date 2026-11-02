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
        $handle = fopen($file, 'r');

        $header = true;

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

            if ($header) {
                $header = false;
                continue;
            }

            KpiScore::create([
                'tahun' => $row[0],
                'nik' => $row[1],
                'nama' => $row[2],
                'dept' => $row[3],
                'jabatan' => $row[4],
                'posisi' => $row[5],
                'total_kpi' => $row[6],
            ]);
        }

        fclose($handle);

        return redirect()->route('kpi.index')->with('success', 'Data KPI berhasil diimport.');
    }
}