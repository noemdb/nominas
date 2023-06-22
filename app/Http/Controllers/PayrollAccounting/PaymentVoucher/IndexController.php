<?php

namespace App\Http\Controllers\PayrollAccounting\PaymentVoucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('payroll-accountings.payment-vouchers.index');
    }
}
