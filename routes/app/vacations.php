<?php

use Illuminate\Support\Facades\Route;

//INI Vacation
use App\Http\Controllers\Vacation\IndexController as VacationIndexController;
use App\Http\Controllers\Vacation\Request\IndexController as VacationRequestIndexController;
use App\Http\Controllers\Vacation\Register\IndexController as VacationRegisterIndexController;
use App\Http\Controllers\Vacation\Planning\IndexController as VacationPlanningIndexController;
use App\Http\Controllers\Vacation\Report\IndexController as VacationReportIndexController;

Route::get('/vacations', [VacationIndexController::class, 'index'])->name('vacations');
Route::get('/vacations/requests', [VacationRequestIndexController::class, 'index'])->name('vacations.requests');
Route::get('/vacations/registers', [VacationRegisterIndexController::class, 'index'])->name('vacations.registers');
Route::get('/vacations/plannings', [VacationPlanningIndexController::class, 'index'])->name('vacations.plannings');
Route::get('/vacations/reports', [VacationReportIndexController::class, 'index'])->name('vacations.reports');
//FIN Vacation
