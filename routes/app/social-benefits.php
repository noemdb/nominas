<?php

use Illuminate\Support\Facades\Route;

//INI social-benefits
use App\Http\Controllers\SocialBenefit\IndexController as SocialBenefitIndexController;
use App\Http\Controllers\SocialBenefit\Register\IndexController as SocialBenefitRegisterIndexController;
use App\Http\Controllers\SocialBenefit\LoanManagement\IndexController as SocialBenefitLoanManagementIndexController;
use App\Http\Controllers\SocialBenefit\Report\IndexController as SocialBenefitReportIndexController;

Route::get('/social-benefits', [SocialBenefitIndexController::class, 'index']);
Route::get('/social-benefits/registers', [SocialBenefitRegisterIndexController::class, 'index']);
Route::get('/social-benefits/loan-managements', [SocialBenefitLoanManagementIndexController::class, 'index']);
Route::get('/social-benefits/reports', [SocialBenefitReportIndexController::class, 'index']);
//FIN SocialBenefit
