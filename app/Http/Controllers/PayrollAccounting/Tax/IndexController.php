<?php

namespace App\Http\Controllers\PayrollAccounting\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('payroll-accountings.taxes.index');
    }
}