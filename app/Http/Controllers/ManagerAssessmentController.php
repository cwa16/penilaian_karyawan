<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerAssessmentController extends Controller
{
    public function index()
    {
        $managers = User::where('status', 'manager')
            ->orderBy('name')
            ->get();

        $departments = User::whereNotNull('dept')
            ->select('dept')
            ->distinct()
            ->orderBy('dept')
            ->pluck('dept');

        $settings = DB::table('manager_department_assessments')
            ->get()
            ->groupBy('manager_nik');

        return view('admin.settings.manager-assessment',compact('managers', 'departments', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'manager_nik' => 'required|exists:users,nik',
            'departments' => 'array',
        ]);

        DB::table('manager_department_assessments')
            ->where('manager_nik', $request->manager_nik)
            ->delete();

        if ($request->departments) {
            foreach ($request->departments as $dept) {
                DB::table('manager_department_assessments')->insert([
                    'manager_nik'     => $request->manager_nik,
                    'dept' => $dept,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }
        }

        return back()->with('success', 'Setting penilaian manager berhasil disimpan');
    }
}
