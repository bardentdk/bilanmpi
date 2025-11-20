<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use App\Http\Controllers\BilanController;
use App\Http\Controllers\BilanMPIController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\GroqController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', function () {
    return redirect()->route('bilans-mpi.index');
});

Route::prefix('bilans-mpi')->name('bilans-mpi.')->group(function () {
    Route::get('/', [BilanMPIController::class, 'index'])->name('index');
    Route::get('/create', [BilanMPIController::class, 'create'])->name('create');
    Route::post('/', [BilanMPIController::class, 'store'])->name('store');
    Route::get('/{bilanMpi}', [BilanMPIController::class, 'show'])->name('show');
    Route::get('/{bilanMpi}/edit', [BilanMPIController::class, 'edit'])->name('edit');
    Route::put('/{bilanMpi}', [BilanMPIController::class, 'update'])->name('update');
    Route::get('/{bilanMpi}/pdf', [BilanMPIController::class, 'downloadPdf'])->name('pdf');
    Route::delete('/{bilanMpi}', [BilanMPIController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
