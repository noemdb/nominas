<?php

use Illuminate\Support\Facades\Route;

//INI Employee
use App\Http\Controllers\Employee\IndexController as EmployeeIndexController;
use App\Http\Controllers\Employee\Personal\IndexController as EmployeePersonalIndexController;
use App\Http\Controllers\Employee\Position\IndexController as EmployeePositionIndexController;
use App\Http\Controllers\Employee\Information\IndexController as EmployeeInformationIndexController;
use App\Http\Controllers\Employee\PreviousWork\IndexController as EmployeePreviousWorkIndexController;
// use App\Http\Controllers\Employee\Salary\IndexController as EmployeeSalaryIndexController;
use App\Http\Controllers\Employee\Attendance\IndexController as EmployeeAttendanceIndexController;
use App\Http\Controllers\Employee\SocialSecurity\IndexController as EmployeeSocialSecurityIndexController;
use App\Http\Controllers\Employee\Training\IndexController as EmployeeTrainingIndexController;
use App\Http\Controllers\Employee\Documentation\IndexController as EmployeeDocumentationIndexController;

Route::get('/employees', [EmployeeIndexController::class, 'index'])->name('employees');
Route::get('/employees/personals', [EmployeePersonalIndexController::class, 'index'])->name('employees.personals');
Route::get('/employees/positions', [EmployeePositionIndexController::class, 'index'])->name('employees.positions');
Route::get('/employees/informations', [EmployeeInformationIndexController::class, 'index'])->name('employees.informations');
Route::get('/employees/previous_works', [EmployeePreviousWorkIndexController::class, 'index'])->name('employees.previous_works');
// Route::get('/employees/salaries', [EmployeeSalaryIndexController::class, 'index'])->name('employees.salaries');
Route::get('/employees/social-security', [EmployeeSocialSecurityIndexController::class, 'index'])->name('employees.social');
Route::get('/employees/trainings', [EmployeeTrainingIndexController::class, 'index'])->name('employees.trainings');
Route::get('/employees/documentations', [EmployeeDocumentationIndexController::class, 'index'])->name('employees.documentations');
Route::get('/employees/attendances', [EmployeeAttendanceIndexController::class, 'index'])->name('employees.attendances');
//FIN Employee
