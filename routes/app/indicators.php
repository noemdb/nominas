<?php

use Illuminate\Support\Facades\Route;

//INI indicators
use App\Http\Controllers\Indicator\IndexController as IndicatorIndexController;
use App\Http\Controllers\Indicator\Benefit\IndexController as IndicatorBenefitIndexController;
use App\Http\Controllers\Indicator\Loan\IndexController as IndicatorLoanIndexController;
use App\Http\Controllers\Indicator\PaymentHistory\IndexController as IndicatorPaymentHistoryIndexController;
use App\Http\Controllers\Indicator\Accumulated\IndexController as IndicatorAccumulatedIndexController;
Route::get('/indicators', [IndicatorIndexController::class, 'index']);
Route::get('/indicators/benefits', [IndicatorBenefitIndexController::class, 'index']);
Route::get('/indicators/loans', [IndicatorLoanIndexController::class, 'index']);
Route::get('/indicators/payment-histories', [IndicatorPaymentHistoryIndexController::class, 'index']);
Route::get('/indicators/accumulated', [IndicatorAccumulatedIndexController::class, 'index']);
//FIN Indicator indicators
