<?php

namespace App\Http\Controllers\Formulation\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('formulations.payrolls.index');
    }
}
