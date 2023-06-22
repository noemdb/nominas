<?php

namespace App\Http\Controllers\Absence\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('absences.registers.index');
    }
}
