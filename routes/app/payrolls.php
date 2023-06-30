<?php

use Illuminate\Support\Facades\Route;

//INI payroll
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

Route::get('/payroll', [PayrollAccountingIndexController::class, 'index'])->name('payroll');
Route::get('/payroll/salaries', [PayrollAccountingSalaryIndexController::class, 'index'])->name('payroll.salaries');
Route::get('/payroll/deductions', [PayrollAccountingDeductionIndexController::class, 'index'])->name('payroll.deductions');
Route::get('/payroll/taxes', [PayrollAccountingTaxIndexController::class, 'index'])->name('payroll.taxes');
Route::get('/payroll/bonifications', [PayrollAccountingBonificationIndexController::class, 'index'])->name('payroll.bonifications');
Route::get('/payroll/incentives', [PayrollAccountingIncentiveIndexController::class, 'index'])->name('payroll.incentives');
Route::get('/payroll/overtimes', [PayrollAccountingOvertimeIndexController::class, 'index'])->name('payroll.overtimes');
Route::get('/payroll/holidays', [PayrollAccountingHolidayIndexController::class, 'index'])->name('payroll.holidays');
Route::get('/payroll/vacations', [PayrollAccountingVacationIndexController::class, 'index'])->name('payroll.vacations');
Route::get('/payroll/payment-vouchers', [PayrollAccountingPaymentVoucherIndexController::class, 'index'])->name('payroll.payment-vouchers');
//FIN payroll
