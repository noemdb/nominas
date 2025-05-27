<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        return view('setup.index-payroll');
    }

    public function create()
    {
        return view('setup.create-payroll');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'description' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        $validated['num_days'] = \Carbon\Carbon::parse($validated['date_start'])
            ->diffInDays($validated['date_end']) + 1;

        Payroll::create($validated);

        return redirect()->route('setup.payrolls.index')
            ->with('success', 'Payroll created successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('setup.show-payroll', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        return view('setup.edit-payroll', compact('payroll'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'description' => 'nullable|string',
            'observations' => 'nullable|string',
        ]);

        $validated['num_days'] = \Carbon\Carbon::parse($validated['date_start'])
            ->diffInDays($validated['date_end']) + 1;

        $payroll->update($validated);

        return redirect()->route('setup.payrolls.index')
            ->with('success', 'Payroll updated successfully.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('setup.payrolls.index')
            ->with('success', 'Payroll deleted successfully.');
    }
}