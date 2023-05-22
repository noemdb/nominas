<?php

use Illuminate\Support\Facades\Route;

//INI payroll-accountings
use App\Http\Controllers\PayrollAccounting\IndexController as PayrollAccountingIndexController;
use App\Http\Controllers\PayrollAccounting\Salary\IndexController as PayrollAccountingSalaryIndexController;
use App\Http\Controllers\PayrollAccounting\Deduction\IndexController as PayrollAccountingDeductionIndexController;
use App\Http\Controllers\PayrollAccounting\Tax\IndexController as PayrollAccountingTaxIndexController;
use App\Http\Controllers\PayrollAccounting\Bonification\IndexController as PayrollAccountingBonificationIndexController;
use App\Http\Controllers\PayrollAccounting\Incentive\IndexController as PayrollAccountingIncentiveIndexController;
use App\Http\Controllers\PayrollAccounting\Overtime\IndexController as PayrollAccountingOvertimeIndexController;
use App\Http\Controllers\PayrollAccounting\Holiday\IndexController as PayrollAccountingHolidayIndexController;
use App\Http\Controllers\PayrollAccounting\Vacation\IndexController as PayrollAccountingVacationIndexController;
use App\Http\Controllers\PayrollAccounting\PaymentVoucher\IndexController as PayrollAccountingPaymentVoucherIndexController;

Route::get('/payroll-accountings', [PayrollAccountingIndexController::class, 'index']);
Route::get('/payroll-accountings/salaries', [PayrollAccountingSalaryIndexController::class, 'index']);
Route::get('/payroll-accountings/deductions', [PayrollAccountingDeductionIndexController::class, 'index']);
Route::get('/payroll-accountings/taxes', [PayrollAccountingTaxIndexController::class, 'index']);
Route::get('/payroll-accountings/bonifications', [PayrollAccountingBonificationIndexController::class, 'index']);
Route::get('/payroll-accountings/incentives', [PayrollAccountingIncentiveIndexController::class, 'index']);
Route::get('/payroll-accountings/overtimes', [PayrollAccountingOvertimeIndexController::class, 'index']);
Route::get('/payroll-accountings/holidays', [PayrollAccountingHolidayIndexController::class, 'index']);
Route::get('/payroll-accountings/vacations', [PayrollAccountingVacationIndexController::class, 'index']);
Route::get('/payroll-accountings/payment-vouchers', [PayrollAccountingPaymentVoucherIndexController::class, 'index']);
//FIN payroll-accountings
