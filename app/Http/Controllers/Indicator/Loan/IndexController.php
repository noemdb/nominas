<?php

namespace App\Http\Controllers\Indicator\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('indicators.loans.index');
    }
}
