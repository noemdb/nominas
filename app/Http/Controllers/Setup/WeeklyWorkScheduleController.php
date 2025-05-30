<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\WeeklyWorkSchedule;
use Illuminate\Http\Request;

class WeeklyWorkScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setup.index-weekly-schedule');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livewire.data-management.weekly-work-schedule-management');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WeeklyWorkSchedule $weeklyWorkSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeeklyWorkSchedule $weeklyWorkSchedule)
    {
        return view('livewire.data-management.weekly-work-schedule-management', compact('weeklyWorkSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeeklyWorkSchedule $weeklyWorkSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeeklyWorkSchedule $weeklyWorkSchedule)
    {
        //
    }
}
