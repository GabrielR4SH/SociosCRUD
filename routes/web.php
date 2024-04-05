<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::get('/home', [PartnerController::class, 'index'])->name('home');
Route::post('/partners', [PartnerController::class, 'store'])->name('partner.store');
Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('partner.edit');
Route::put('/partners/{id}', [PartnerController::class, 'update'])->name('partner.update');
Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('partner.destroy');
