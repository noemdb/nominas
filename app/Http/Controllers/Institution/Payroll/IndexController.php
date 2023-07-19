<?php

namespace App\Http\Controllers\Institution\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('institutions.payrolls.index');
    }
}
