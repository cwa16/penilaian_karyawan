<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function kpiKualitatif()
    {
        return view('export.kpi-kualitatif');
    }
}