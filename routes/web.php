<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use App\Http\Controllers\BilanController;
use App\Http\Controllers\BilanMPIController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\GroqController;

// Page d'accueil redirige vers les bilans
Route::get('/', function () {
    return redirect()->route('bilans-mpi.index');
});

// Routes des bilans MPI - Protégées par authentification
Route::prefix('bilans-mpi')->name('bilans-mpi.')->middleware(['auth'])->group(function () {
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

// Routes de gestion des utilisateurs - Admin uniquement
Route::middleware(['auth'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
