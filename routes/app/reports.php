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

Route::get('/reports', [ReportIndexController::class, 'index'])->name('reports');
Route::get('/reports/payrolls', [ReportPayrollIndexController::class, 'index'])->name('reports.payrolls');
Route::get('/reports/benefits', [ReportBenefitIndexController::class, 'index'])->name('reports.benefits');
Route::get('/reports/vacations', [ReportVacationIndexController::class, 'index'])->name('reports.vacations');
Route::get('/reports/absences', [ReportAbsenceIndexController::class, 'index'])->name('reports.absences');
Route::get('/reports/legal-compliances', [ReportLegalComplianceIndexController::class, 'index'])->name('reports.legal-compliances');
Route::get('/reports/salary-comparisons', [ReportSalaryComparisonIndexController::class, 'index'])->name('reports.salary-comparisons');
Route::get('/reports/process-efficiencies', [ReportProcessEfficiencyIndexController::class, 'index'])->name('reports.process-efficiencies');
Route::get('/reports/scheduleds', [ReportScheduledIndexController::class, 'index'])->name('reports.scheduleds');
//FIN Report
