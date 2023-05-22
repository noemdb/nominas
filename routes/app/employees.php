<?php

use Illuminate\Support\Facades\Route;

//INI Employee
use App\Http\Controllers\Employee\IndexController as EmployeeIndexController;
use App\Http\Controllers\Employee\Personal\IndexController as EmployeePersonalIndexController;
use App\Http\Controllers\Employee\Information\IndexController as EmployeeInformationIndexController;
use App\Http\Controllers\Employee\Salary\IndexController as EmployeeSalaryIndexController;
use App\Http\Controllers\Employee\SocialSecurity\IndexController as EmployeeSocialSecurityIndexController;
use App\Http\Controllers\Employee\Training\IndexController as EmployeeTrainingIndexController;
use App\Http\Controllers\Employee\Documentation\IndexController as EmployeeDocumentationIndexController;

Route::get('/employees', [EmployeeIndexController::class, 'index']);
Route::get('/employees/personals', [EmployeePersonalIndexController::class, 'index']);
Route::get('/employees/informations', [EmployeeInformationIndexController::class, 'index']);
Route::get('/employees/salaries', [EmployeeSalaryIndexController::class, 'index']);
Route::get('/employees/social-security', [EmployeeSocialSecurityIndexController::class, 'index']);
Route::get('/employees/trainings', [EmployeeTrainingIndexController::class, 'index']);
Route::get('/employees/documentations', [EmployeeDocumentationIndexController::class, 'index']);
//FIN Employee
