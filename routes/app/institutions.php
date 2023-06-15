<?php

use Illuminate\Support\Facades\Route;

//INI Institution
use App\Http\Controllers\Institution\IndexController as InstitutionIndexController;
use App\Http\Controllers\Institution\Autority\IndexController as InstitutionAutorityIndexController;
use App\Http\Controllers\Institution\Bank\IndexController as InstitutionBankIndexController;
use App\Http\Controllers\Institution\Schedule\IndexController as InstitutionScheduleIndexController;
use App\Http\Controllers\Institution\Area\IndexController as InstitutionAreaIndexController;
use App\Http\Controllers\Institution\Rol\IndexController as InstitutionRolIndexController;
use App\Http\Controllers\Institution\Special\IndexController as InstitutionSpecialIndexController;

Route::get('/institutions', [InstitutionIndexController::class, 'index'])->name('institutions');
Route::get('/institutions/autorities', [InstitutionAutorityIndexController::class, 'index'])->name('institutions.autorities');
Route::get('/institutions/banks', [InstitutionBankIndexController::class, 'index'])->name('institutions.banks');
Route::get('/institutions/schedules', [InstitutionScheduleIndexController::class, 'index'])->name('institutions.schedules');
Route::get('/institutions/areas', [InstitutionAreaIndexController::class, 'index'])->name('institutions.areas');
Route::get('/institutions/rols', [InstitutionRolIndexController::class, 'index'])->name('institutions.rols');
Route::get('/institutions/specials', [InstitutionSpecialIndexController::class, 'index'])->name('institutions.specials');
//FIN Institution
