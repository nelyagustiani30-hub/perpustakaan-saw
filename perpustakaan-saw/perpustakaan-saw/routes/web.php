<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\SawController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');

Route::resource('books', BookController::class)->except('show');

Route::prefix('saw')->name('saw.')->group(function () {
    Route::get('/', [SawController::class, 'index'])->name('index');
    Route::get('/kriteria', [SawController::class, 'kriteria'])->name('kriteria');
    Route::put('/kriteria', [SawController::class, 'updateKriteria'])->name('kriteria.update');
});