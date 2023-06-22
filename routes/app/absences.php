<?php

use Illuminate\Support\Facades\Route;

//INI Absence
use App\Http\Controllers\Absence\IndexController as AbsenceIndexController;
use App\Http\Controllers\Absence\Request\IndexController as AbsenceRequestIndexController;
use App\Http\Controllers\Absence\Register\IndexController as AbsenceRegisterIndexController;
use App\Http\Controllers\Absence\Policy\IndexController as AbsencePolicyIndexController;
use App\Http\Controllers\Absence\Report\IndexController as AbsenceReportIndexController;

Route::get('/absences', [AbsenceIndexController::class, 'index'])->name('absences');
Route::get('/absences/requests', [AbsenceRequestIndexController::class, 'index'])->name('absences.requests');
Route::get('/absences/registers', [AbsenceRegisterIndexController::class, 'index'])->name('absences.registers');
Route::get('/absences/policies', [AbsencePolicyIndexController::class, 'index'])->name('absences.policies');
Route::get('/absences/reports', [AbsenceReportIndexController::class, 'index'])->name('absences.reports');
//FIN Absence
