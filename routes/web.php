<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->name('orders.index');
Route::get('/import', [OrderController::class, 'import'])->name('orders.import');
