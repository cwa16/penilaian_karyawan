<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $path = $file->getRealPath();

        $data = array_map('str_getcsv', file($path));

        // skip header
        unset($data[0]);

        foreach ($data as $row) {
            Employee::create([
                'nik'        => $row[0],
                'name'       => $row[1],
                'status'     => $row[2],
                'dept'       => $row[3],
                'jabatan'    => $row[4],
                'pendidikan' => $row[5],
            ]);
        }

        return back()->with('success','Data karyawan berhasil diimport!');
    }
}
