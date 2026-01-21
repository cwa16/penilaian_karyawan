<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = fopen($request->file('file'), 'r');

        $header = fgetcsv($file); // skip header

        while (($row = fgetcsv($file)) !== FALSE) {
            Employee::create([
                'nik' => $row[0],
                'name' => $row[1],
                'status' => $row[2],
                'dept' => $row[3],
                'jabatan' => $row[4],
                'pendidikan' => $row[5],
            ]);
        }

        fclose($file);
return redirect()->route('dashboard')
                 ->with('success', 'Data berhasil diimport!');

    }
}
