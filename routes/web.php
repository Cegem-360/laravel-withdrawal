<?php

declare(strict_types=1);

use Cegem360\Withdrawal\Http\Controllers\WithdrawalFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WithdrawalFormController::class, 'show'])->name('withdrawal.form');
Route::post('/', [WithdrawalFormController::class, 'store'])->name('withdrawal.submit');
Route::get('/koszonjuk', [WithdrawalFormController::class, 'success'])->name('withdrawal.success');
