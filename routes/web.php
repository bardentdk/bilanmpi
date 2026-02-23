<?php

use App\Http\Controllers\BilanMPIController;
use Illuminate\Support\Facades\Route;

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
    
    // Export sélection
    Route::post('/export/selected', [BilanMPIController::class, 'exportSelectedPdf'])->name('export.selected');
});

require __DIR__.'/auth.php';
