<?php

declare(strict_types=1);

use Cegem360\Elallas\Http\Controllers\WithdrawalFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WithdrawalFormController::class, 'show'])->name('elallas.form');
Route::post('/', [WithdrawalFormController::class, 'store'])->name('elallas.submit');
Route::get('/koszonjuk', [WithdrawalFormController::class, 'success'])->name('elallas.success');
