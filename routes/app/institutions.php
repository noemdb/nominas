<?php

use Illuminate\Support\Facades\Route;

//INI Institution
use App\Http\Controllers\Institution\IndexController as InstitutionIndexController;
use App\Http\Controllers\Institution\Autority\IndexController as InstitutionAutorityIndexController;
use App\Http\Controllers\Institution\Bank\IndexController as InstitutionBankIndexController;
use App\Http\Controllers\Institution\Schedule\IndexController as InstitutionScheduleIndexController;
use App\Http\Controllers\Institution\Rol\IndexController as InstitutionRolIndexController;
use App\Http\Controllers\Institution\Rol\IndexController as InstitutionSpecialIndexController;

Route::get('/institutions', [InstitutionIndexController::class, 'index']);
Route::get('/institutions/autorities', [InstitutionAutorityIndexController::class, 'index']);
Route::get('/institutions/banks', [InstitutionBankIndexController::class, 'index']);
Route::get('/institutions/schedules', [InstitutionScheduleIndexController::class, 'index']);
Route::get('/institutions/rols', [InstitutionRolIndexController::class, 'index']);
Route::get('/institutions/specials', [InstitutionSpecialIndexController::class, 'index']);
//FIN Institution
