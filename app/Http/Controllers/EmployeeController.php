<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by NIK / Name
        if ($request->search) {
            $query->where('nik', 'like', "%{$request->search}%")
                ->orWhere('name', 'like', "%{$request->search}%");
        }

        $employees = $query
            ->orderBy('name')
            ->paginate(15);

        return view('admin.employees.index', compact('employees'));
    }
}
