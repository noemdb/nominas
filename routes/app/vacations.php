<?php

use Illuminate\Support\Facades\Route;

//INI Vacation
use App\Http\Controllers\Vacation\IndexController as VacationIndexController;
use App\Http\Controllers\Vacation\Request\IndexController as VacationRequestIndexController;
use App\Http\Controllers\Vacation\Register\IndexController as VacationRegisterIndexController;
use App\Http\Controllers\Vacation\Planning\IndexController as VacationPlanningIndexController;
use App\Http\Controllers\Vacation\Report\IndexController as VacationReportIndexController;

Route::get('/vacations', [VacationIndexController::class, 'index']);
Route::get('/vacations/requests', [VacationRequestIndexController::class, 'index']);
Route::get('/vacations/registers', [VacationRegisterIndexController::class, 'index']);
Route::get('/vacations/plannings', [VacationPlanningIndexController::class, 'index']);
Route::get('/vacations/reports', [VacationReportIndexController::class, 'index']);
//FIN Vacation
