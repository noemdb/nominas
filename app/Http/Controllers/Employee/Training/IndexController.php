<?php

namespace App\Http\Controllers\Employee\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('employees.trainings.index');
    }
}
