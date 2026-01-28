<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PerformancePeriodController;
use App\Http\Controllers\ManagerAssessmentController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/upload', function () {return view('upload');});
Route::post('/import-csv', [ImportController::class, 'import']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/import', function () {
    return view('import');
});

Route::post('/import-csv', [EmployeeController::class, 'import'])->name('import.csv');

// redirect awal ke login
Route::get('/', function () {
    return redirect('/login');
});

// dashboard (WAJIB LOGIN)

// profile (WAJIB LOGIN)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/performance/input/{periodId}/{nik}', [PerformanceController::class, 'form'])->name('performance.input');
Route::post('/performance/input/save', [PerformanceController::class, 'save']);

Route::get('/performance/{period}/employees', [PerformanceController::class, 'employeesByPeriod'])->name('performance.employees');

Route::get('/performance/periods', [PerformancePeriodController::class, 'index'])->name('performance.periods');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('/settings/manager-assessment', [ManagerAssessmentController::class, 'index'])->name('settings.manager-assessment');

Route::post('/settings/manager-assessment', [ManagerAssessmentController::class, 'store'])->name('settings.manager-assessment.store');

Route::get('/summary/{id}', [SummaryController::class, 'index'])->name('summary');

// ROUTE LOGIN BAWAAN BREEZE
require __DIR__ . '/auth.php';
