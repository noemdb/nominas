<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setup.index-deduction');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livewire.setup.create-edit-deduction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'type' => 'required|in:fijo,variable',
            'amount' => 'required_if:type,fijo|numeric|min:0',
            'percentage' => 'required_if:type,variable|numeric|min:0|max:100',
            'institution_id' => 'nullable|exists:institutions,id',
            'area_id' => 'nullable|exists:areas,id',
            'rol_id' => 'nullable|exists:roles,id',
            'worker_id' => 'nullable|exists:workers,id',
            'position_id' => 'nullable|exists:positions,id',
        ]);

        Deduction::create($validated);

        return redirect()->route('deductions.index')
            ->with('success', 'Deducción creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deduction $deduction)
    {
        return view('livewire.setup.show-deduction', compact('deduction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deduction $deduction)
    {
        return view('livewire.setup.create-edit-deduction', compact('deduction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deduction $deduction)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'type' => 'required|in:fijo,variable',
            'amount' => 'required_if:type,fijo|numeric|min:0',
            'percentage' => 'required_if:type,variable|numeric|min:0|max:100',
            'institution_id' => 'nullable|exists:institutions,id',
            'area_id' => 'nullable|exists:areas,id',
            'rol_id' => 'nullable|exists:roles,id',
            'worker_id' => 'nullable|exists:workers,id',
            'position_id' => 'nullable|exists:positions,id',
        ]);

        $deduction->update($validated);

        return redirect()->route('deductions.index')
            ->with('success', 'Deducción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deduction $deduction)
    {
        $deduction->delete();

        return redirect()->route('deductions.index')
            ->with('success', 'Deducción eliminada exitosamente.');
    }
}