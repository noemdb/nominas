<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require(__DIR__ . '/app/institutions.php');
require(__DIR__ . '/app/employees.php');
require(__DIR__ . '/app/formulations.php');
require(__DIR__ . '/app/payroll-accountings.php');
require(__DIR__ . '/app/social-benefits.php');
require(__DIR__ . '/app/vacations.php');
require(__DIR__ . '/app/absences.php');
require(__DIR__ . '/app/reports.php');
require(__DIR__ . '/app/indicators.php');
require(__DIR__ . '/app/handbooks.php');


/*

-. Institución (Institution) - (institutions)
    *. Registro de autoridades (autority) - (institutions.autorities)
    *. Registro de bancos (bank) (institutions.banks)
    *. Horarios laborales (schedule) (institutions.schedules)
    *. Roles y cargos (rol) (institutions.rols)
    *. Especiales (spaecial) (institutions.specials)
-. Empleados (Employees - Employee)
    *. Información personal (Personal -personals)
    *. Información laboral (Information - informations)
    *. Información salarial (salary salaries)
    *. Información de seguridad social (SocialSecurity)
    *. Información de formación y capacitación (Training training trainings)
    *. Documentación (Documentation documentations documentation)

-. Formulaciones (Formulation - formulations - formulation)
    *. Nómina (Payroll payrolls payroll)
    *. Prestaciones sociales (SocialBenefit social-benefits social-benefit)
    *. Vacaciones (Vacation vacations vacations)
-. Cálculo de nómina (PayrollAccounting payroll-accountings payroll-accounting)
    *. Salarios (Salary salaries salary)
    *. Deducciones (Deduction deductions deduction)
    *. Impuestos (Tax taxes tax)
    *. Bonificaciones (Bonification bonifications bonification)
    *. Incentivos (Incentive incentives incentive)
    *. Horas extras (Overtime overtimes overtime)
    *. Días feriados (Holiday holidays holiday)
    *. Vacaciones (Vacation vacations)
    *. Comprobantes de pago (PaymentVoucher payment-vouchers)
-. Prestaciones sociales (SocialBenefit social-benefits)
    *. Registro (Register registers)
    *. Gestión de préstamos (LoanManagement loan-managements)
    *. Reportes y estadísticas (reports)
-. Gestión de vacaciones (Vacation vacations vacation)
    *. Solicitud (Request requests)
    *. Registro (Register registers)
    *. Planificación (Planning plannings)
    *. Reportes y estadísticas (Report reports)
-. Gestión de ausencias y permisos (Absence absences)
    *. Solicitud (Request requests)
    *. Registro (Register registers)
    *. Gestión de políticas (Policy policies)
    *. Reportes y estadísticas (Report reports)
-. Generación de reportes (Report reports)
    *. Nómina (Payroll payrolls)
    *. Prestaciones (Benefit benefits)
    *. Vacaciones (Vacation vacations)
    *. Ausencias (Absence absences)
    *. Cumplimiento legal (LegalCompliance legal-compliances)
    *. Comparación salarial (SalaryComparison salary-comparisons)
    *. Eficiencia de los procesos (ProcessEfficiency process-efficiencies)
    *. Reportes programados (Scheduled scheduleds)
-. Indicadores de gestión (Indicator indicators)
    *. Prestaciones sociales (Benefit benefits)
    *. Préstamos (Loan loans)
    *. Histórico de pagos (PaymentHistory payment-histories)
    *. Total acumulado (Accumulated accumulated)
-. Manuales (Manual manuals)
    *. Institución (Institution institutions)
    *. Empleados (Employees - Employee)
    *. Cálculo de nómina (PayrollAccounting payroll-accounting)
    *. Prestaciones sociales (SocialBenefit - social-benefits)
    *. Gestión de vacaciones (Vacation vacations)
    *. Generación de reportes (Report reports)


*/
