<?php

namespace App\Http\Controllers;

use App\Models\PerformanceCriteria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PerformanceCriteriaController extends Controller
{
    public function index()
    {
        $criteria = PerformanceCriteria::orderBy('code')->get();
        $criteria = PerformanceCriteria::with('scales')
        ->orderByRaw('CAST(SUBSTRING(code, 2) AS UNSIGNED)')
        ->get();

        return view('criteria.index', compact('criteria'));
    }

    public function exportPdf()
    {
        $criteria = PerformanceCriteria::with('scales')
            ->orderByRaw('CAST(SUBSTRING(code, 2) AS UNSIGNED)')
            ->get();

        $pdf = Pdf::loadView('criteria.export_pdf', compact('criteria'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('master-criteria.pdf');
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:performance_criteria,code',
            'name' => 'required',
            'description' => 'nullable',
            'weight' => 'required|numeric|min:1|max:100'
        ]);

        PerformanceCriteria::create($request->all());

        return redirect()->route('criteria.index')
                        ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $criteria = PerformanceCriteria::findOrFail($id);
        return view('criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id)
    {
        $criteria = PerformanceCriteria::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:performance_criteria,code,' . $id,
            'name' => 'required',
            'description' => 'nullable',
            'weight' => 'required|numeric|min:1|max:100'
        ]);

        DB::transaction(function () use ($request, $criteria) {

            // Update main criteria
            $criteria->update([
                'section'     => $request->section,
                'code'        => $request->code,
                'name'        => $request->name,
                'description' => $request->description,
                'weight'      => $request->weight,
            ]);

            // Update scales (I - V)
            foreach ($request->scales as $score => $desc) {

                $criteria->scales()->updateOrCreate(
                    [
                        'score' => $score
                    ],
                    [
                        'description' => $desc
                    ]
                );
            }
        });    

        return redirect()->route('criteria.index')
            ->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy($id)
    {
        PerformanceCriteria::destroy($id);
        return back()->with('success', 'Kriteria berhasil dihapus');
    }
}