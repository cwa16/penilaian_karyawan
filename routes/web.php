<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ImportController;


Route::get('/upload', function () { return view('upload'); });
Route::post('/import-csv', [ImportController::class, 'import']);




Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::get('/import', function(){
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

// ROUTE LOGIN BAWAAN BREEZE
require __DIR__.'/auth.php';
