<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Worker;
use App\Models\PayrollWorkerDetail;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with tabs.
     */
    public function index()
    {
        // Get summary data for indicators
        $indicators = $this->getDashboardIndicators();

        return view('dashboard', [
            'indicators' => $indicators
        ]);
    }

    /**
     * Get dashboard indicators data.
     */
    private function getDashboardIndicators()
    {
        // Get active workers count
        $activeWorkers = Worker::where('is_active', true)->count();

        // Get current payroll summary if exists
        $currentPayroll = Payroll::where('status_active', true)
            ->latest()
            ->first();

        $payrollSummary = $currentPayroll
            ? PayrollWorkerDetail::getPayrollSummary($currentPayroll->id)
            : null;

        // Calculate total amount paid from all approved payrolls
        $totalAmountPaid = Payroll::where('status_approved', true)
            ->with('payrollWorkerDetails')
            ->get()
            ->sum(function ($payroll) {
                return $payroll->payrollWorkerDetails->sum('net_pay');
            });

        // Calculate total deductions (discounts + deductions) from all approved payrolls
        $totalDeductions = Payroll::where('status_approved', true)
            ->with(['payrollWorkerDetails' => function ($query) {
                $query->with(['discounts', 'deductions']);
            }])
            ->get()
            ->sum(function ($payroll) {
                return $payroll->payrollWorkerDetails->sum(function ($detail) {
                    $discounts = $detail->discounts->where('status_active', true)->sum('amount');
                    $deductions = $detail->deductions->where('status_active', true)->sum('amount');
                    return $discounts + $deductions;
                });
            });

        return [
            'active_workers' => $activeWorkers,
            'current_payroll' => $currentPayroll,
            'payroll_summary' => $payrollSummary,
            'total_payrolls' => Payroll::count(),
            'approved_payrolls' => Payroll::where('status_approved', true)->count(),
            'pending_payrolls' => Payroll::where('status_approved', false)
                ->where('status_active', true)
                ->count(),
            'total_amount_paid' => $totalAmountPaid,
            'total_deductions' => $totalDeductions
        ];
    }
}
