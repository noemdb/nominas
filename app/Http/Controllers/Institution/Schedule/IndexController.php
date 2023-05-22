<?php

namespace App\Http\Controllers\Institution\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('institutions.schedules.index');
    }
}
