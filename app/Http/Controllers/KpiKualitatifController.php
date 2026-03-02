<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KpiKualitatifController extends Controller
{
    public function index()
    {
        return view('kpi-kualitatif.index');
    }
}