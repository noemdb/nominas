<?php

namespace App\Http\Controllers\PayrollAccounting\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('payroll-accountings.salaries.index');
    }
}
