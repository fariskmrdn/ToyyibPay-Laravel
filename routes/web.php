<?php

use App\Http\Controllers\ToyyibPayController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ToyyibPayController::class, 'paymentPage'])->name('index');
Route::get('/callBack', [ToyyibPayController::class, 'callBack'])->name('callBack');
Route::post('/pay', [ToyyibPayController::class, 'pay'])->name('pay');

 