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

-. Institución
    *. Registro de instituciones: route('institutions')
    *. Registro de autoridades: route('institutions.autorities')
    *. Registro de bancos: route('institutions.banks')
    *. Horarios laborales: route('institutions.schedules')
    *. Roles y cargos: route('institutions.rols')
    *. Especiales: route('institutions.specials')
-. Empleados (Employees - Employee)
    *. Inicio: route('employees')
    *. Inf. personal: route('employees.personals')
    *. Inf. laboral: route('employees.informations')
    *. Inf. salarial: route('employees.salaries')
    *. Inf. de seg. social: route('employees.social')
    *. Inf. de formación: route('employees.trainings')
    *. Documentación: route('employees.documentations')

-. Formulaciones (Formulation - formulations - formulation)
    *. Inicio: route('formulations')
    *. Nómina: route('formulations.payrolls')
    *. Prestaciones sociales: route('formulations.social-benefits')
    *. Vacaciones: route('formulations.vacations')
-. Cálculo de nómina (PayrollAccounting payroll-accountings payroll-accounting)
    *. Inicio: route('payroll-accountings')
    *. Salarios: route('payroll-accountings.salaries')
    *. Deduccione: route('payroll-accountings.deductions')
    *. Impuestos: route('payroll-accountings.taxes')
    *. Bonificaciones: route('payroll-accountings.bonifications')
    *. Incentivos: route('payroll-accountings.incentives')
    *. Horas extras: route('payroll-accountings.overtimes')
    *. Días feriados: route('payroll-accountings.holidays')
    *. Vacaciones: route('payroll-accountings.vacations')
    *. Comprobantes de pago: route('payroll-accountings.payment-vouchers')
-. Prestaciones sociales (SocialBenefit social-benefits)
    *. Inicio: route('social-benefits')
    *. Registro: route('social-benefits.registers')
    *. Gestión de préstamos: route('social-benefits.loan-managements')
    *. Reportes y estadísticas: route('social-benefits.reports')
-. Gestión de vacaciones (Vacation vacations vacation)
    *. Inicio: route('vacations')
    *. Solicitud: route('vacations.requests')
    *. Registro: route('vacations.registers')
    *. Planificación: route('vacations.plannings')
    *. Reportes y estadísticas: route('vacations.reports')
-. Gestión de ausencias y permisos
    *. Inicio route('absences')
    *. Solicitud: route('absences.requests')
    *. Registro: route('absences.registers')
    *. Gestión de políticas: route('absences.policies')
    *. Reportes y estadísticas: route('absences.reports')
-. Generación de reportes (Report reports)
    *. Inicio: route('reports')
    *. Nómina: route('reports.payrolls')
    *. Prestaciones: route('reports.benefits')
    *. Vacaciones: route('reports.vacations')
    *. Ausencias: route('reports.absences')
    *. Cumplimiento legal: route('reports.legal-compliances')
    *. Comparación salarial: route('reports.salary-comparisons')
    *. Eficiencia de los procesos: route('reports.process-efficiencies')
    *. Reportes programados: route('reports.scheduleds')
-. Indicadores de gestión (Indicator indicators)
    *. Inicio: route('indicators')
    *. Prestaciones sociales: route('indicators.benefits')
    *. Préstamos: route('indicators.loans')
    *. Histórico de pagos: route('indicators.payment-histories')
    *. Total acumulado: route('indicators.accumulated')
-. Manuales (Manual manuals)
    *. Inicio: route('handbooks')
    *. Institución: route('handbooks.institutions')
    *. Empleados: route('handbooks.employees')
    *. Cálculo de nómina: route('handbooks.payroll-accountings')
    *. Prestaciones sociales: route('handbooks.social-benefits')
    *. Gestión de vacaciones: route('handbooks.vacations')
    *. Generación de reportes: route('handbooks.reports')


    */
