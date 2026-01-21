<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // pastikan model Employee

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $status = $request->get('status');
        $dept = $request->get('dept');
        $jabatan = $request->get('jabatan');
        $search = $request->get('search');

        // Query employee dengan kondisi optional
        $query = Employee::query();

        if($status) $query->where('status', $status);
        if($dept) $query->where('dept', $dept);
        if($jabatan) $query->where('jabatan', $jabatan);
        if($search) $query->where('name', 'like', '%'.$search.'%');

        $employees = $query->get();

        // Ambil data unik untuk dropdown filter
        $allStatus = Employee::select('status')->distinct()->pluck('status');
        $allDept = Employee::select('dept')->distinct()->pluck('dept');
        $allJabatan = Employee::select('jabatan')->distinct()->pluck('jabatan');

        return view('dashboard', compact(
            'employees', 'status', 'dept', 'jabatan', 'search',
            'allStatus', 'allDept', 'allJabatan'
        ));
    }
}
