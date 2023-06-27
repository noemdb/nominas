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

Route::get('/payroll-accountings', [PayrollAccountingIndexController::class, 'index'])->name('payroll-accountings');
Route::get('/payroll-accountings/salaries', [PayrollAccountingSalaryIndexController::class, 'index'])->name('payroll-accountings.salaries');
Route::get('/payroll-accountings/deductions', [PayrollAccountingDeductionIndexController::class, 'index'])->name('payroll-accountings.deductions');
Route::get('/payroll-accountings/taxes', [PayrollAccountingTaxIndexController::class, 'index'])->name('payroll-accountings.taxes');
Route::get('/payroll-accountings/bonifications', [PayrollAccountingBonificationIndexController::class, 'index'])->name('payroll-accountings.bonifications');
Route::get('/payroll-accountings/incentives', [PayrollAccountingIncentiveIndexController::class, 'index'])->name('payroll-accountings.incentives');
Route::get('/payroll-accountings/overtimes', [PayrollAccountingOvertimeIndexController::class, 'index'])->name('payroll-accountings.overtimes');
Route::get('/payroll-accountings/holidays', [PayrollAccountingHolidayIndexController::class, 'index'])->name('payroll-accountings.holidays');
Route::get('/payroll-accountings/vacations', [PayrollAccountingVacationIndexController::class, 'index'])->name('payroll-accountings.vacations');
Route::get('/payroll-accountings/payment-vouchers', [PayrollAccountingPaymentVoucherIndexController::class, 'index'])->name('payroll-accountings.payment-vouchers');
//FIN payroll-accountings
