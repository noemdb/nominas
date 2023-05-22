<?php

use Illuminate\Support\Facades\Route;

//INI Formulation
use App\Http\Controllers\Formulation\IndexController as FormulationIndexController;
use App\Http\Controllers\Formulation\Payroll\IndexController as FormulationPayrollIndexController;
use App\Http\Controllers\Formulation\SocialBenefit\IndexController as FormulationSocialBenefitIndexController;
use App\Http\Controllers\Formulation\Vacation\IndexController as FormulationVacationIndexController;

Route::get('/formulations', [FormulationIndexController::class, 'index']);
Route::get('/formulations/payrolls', [FormulationPayrollIndexController::class, 'index']);
Route::get('/formulations/social-benefits', [FormulationSocialBenefitIndexController::class, 'index']);
Route::get('/formulations/vacations', [FormulationVacationIndexController::class, 'index']);
//FIN Formulation
