<?php

use Illuminate\Support\Facades\Route;

//INI Report
use App\Http\Controllers\Report\IndexController as ReportIndexController;
use App\Http\Controllers\Report\Payroll\IndexController as ReportPayrollIndexController;
use App\Http\Controllers\Report\Benefit\IndexController as ReportBenefitIndexController;
use App\Http\Controllers\Report\Vacation\IndexController as ReportVacationIndexController;
use App\Http\Controllers\Report\Absence\IndexController as ReportAbsenceIndexController;
use App\Http\Controllers\Report\LegalCompliance\IndexController as ReportLegalComplianceIndexController;
use App\Http\Controllers\Report\SalaryComparison\IndexController as ReportSalaryComparisonIndexController;
use App\Http\Controllers\Report\ProcessEfficiency\IndexController as ReportProcessEfficiencyIndexController;
use App\Http\Controllers\Report\Scheduled\IndexController as ReportScheduledIndexController;

Route::get('/reports', [ReportIndexController::class, 'index']);
Route::get('/reports/payrolls', [ReportPayrollIndexController::class, 'index']);
Route::get('/reports/benefits', [ReportBenefitIndexController::class, 'index']);
Route::get('/reports/vacations', [ReportVacationIndexController::class, 'index']);
Route::get('/reports/absences', [ReportAbsenceIndexController::class, 'index']);
Route::get('/reports/legal-compliances', [ReportLegalComplianceIndexController::class, 'index']);
Route::get('/reports/salary-comparisons', [ReportSalaryComparisonIndexController::class, 'index']);
Route::get('/reports/process-efficiencies', [ReportProcessEfficiencyIndexController::class, 'index']);
Route::get('/reports/scheduleds', [ReportScheduledIndexController::class, 'index']);
//FIN Report
