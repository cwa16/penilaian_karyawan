<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PerformanceCriteria;
use Illuminate\Http\Request;
use App\Models\PerformanceScaleDescription;
class PerformanceCriteriaController extends Controller
{
  public function exportPdf()
{
    $criteria = PerformanceCriteria::with('scales')
        ->orderByRaw('CAST(SUBSTRING(code, 2) AS UNSIGNED)')
        ->get();

    $pdf = Pdf::loadView('criteria.export_pdf', compact('criteria'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('master-criteria.pdf');
}

 
 public function index()
        {
            $criteria = PerformanceCriteria::with('scales')
                            ->orderBy('id')
                            ->get();   // ⬅️ TIDAK ADA groupBy

            return view('criteria.index', compact('criteria'));
        }
            public function create()
        {
            $sections = \App\Models\PerformanceCriteria::select('section')
                            ->distinct()
                            ->orderBy('section')
                            ->pluck('section');

            return view('criteria.create', compact('sections'));
        }
    public function store(Request $request)
    {
        // 1️⃣ Simpan data utama ke performance_criteria
       $criteria = PerformanceCriteria::create([
            'section' => $request->section,
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->definition,
            'weight' => 0,
        ]);

        // 2️⃣ Simpan score 1–5 ke performance_scale_descriptions
       $scales = [
            1 => $request->score_1,
            2 => $request->score_2,
            3 => $request->score_3,
            4 => $request->score_4,
            5 => $request->score_5,
        ];

        foreach ($scales as $score => $desc) {
            PerformanceScaleDescription::create([
                'criteria_id' => $criteria->id,
                'score' => $score,
                'description' => $desc,
            ]);
        }

        return redirect()->route('criteria.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $criteria = PerformanceCriteria::findOrFail($id);
        return view('criteria.edit', compact('criteria'));
    }

 public function update(Request $request, PerformanceCriteria $criteria)
{
    $request->validate([
        'section' => 'required',
        'code' => 'required',
        'name' => 'required',
    ]);

    $criteria->update([
        'section' => $request->section,
        'code' => $request->code,
        'name' => $request->name,
        'description' => $request->description,
    ]);

    if ($request->scales) {
        foreach ($request->scales as $score => $description) {
            $criteria->scales()->updateOrCreate(
                [
                    'criteria_id' => $criteria->id,
                    'score' => $score
                ],
                [
                    'description' => $description
                ]
            );
        }
    }

    return redirect()->route('criteria.index')
        ->with('success', 'Kriteria berhasil diupdate.');
}
    public function destroy($id)
    {
        PerformanceCriteria::destroy($id);
        return back()->with('success', 'Kriteria berhasil dihapus');
    }
}
