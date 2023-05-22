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

Route::get('/handbooks', [HandbookIndexController::class, 'index']);
Route::get('/handbooks/institutions', [HandbookInstitutionIndexController::class, 'index']);
Route::get('/handbooks/employees', [HandbookEmployeeIndexController::class, 'index']);
Route::get('/handbooks/payroll-accountings', [HandbookPayrollAccountingIndexController::class, 'index']);
Route::get('/handbooks/social-benefits', [HandbookSocialBenefitIndexController::class, 'index']);
Route::get('/handbooks/vacations', [HandbookVacationIndexController::class, 'index']);
Route::get('/handbooks/reports', [HandbookReportIndexController::class, 'index']);
//FIN Handbook Handbook
