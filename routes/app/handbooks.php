<?php

use Illuminate\Support\Facades\Route;

//INI manuals
use App\Http\Controllers\Handbook\IndexController as HandbookIndexController;
use App\Http\Controllers\Handbook\Institution\IndexController as HandbookInstitutionIndexController;
use App\Http\Controllers\Handbook\Employee\IndexController as HandbookEmployeeIndexController;
use App\Http\Controllers\Handbook\PayrollAccounting\IndexController as HandbookPayrollAccountingIndexController;
use App\Http\Controllers\Handbook\SocialBenefit\IndexController as HandbookSocialBenefitIndexController;
use App\Http\Controllers\Handbook\Vacation\IndexController as HandbookVacationIndexController;
use App\Http\Controllers\Handbook\Report\IndexController as HandbookReportIndexController;

Route::get('/handbooks', [HandbookIndexController::class, 'index'])->name('handbooks');
Route::get('/handbooks/institutions', [HandbookInstitutionIndexController::class, 'index'])->name('handbooks.institutions');
Route::get('/handbooks/employees', [HandbookEmployeeIndexController::class, 'index'])->name('handbooks.employees');
Route::get('/handbooks/payroll-accountings', [HandbookPayrollAccountingIndexController::class, 'index'])->name('handbooks.payroll-accountings');
Route::get('/handbooks/social-benefits', [HandbookSocialBenefitIndexController::class, 'index'])->name('handbooks.social-benefits');
Route::get('/handbooks/vacations', [HandbookVacationIndexController::class, 'index'])->name('handbooks.vacations');
Route::get('/handbooks/reports', [HandbookReportIndexController::class, 'index'])->name('handbooks.reports');
//FIN Handbook Handbook
