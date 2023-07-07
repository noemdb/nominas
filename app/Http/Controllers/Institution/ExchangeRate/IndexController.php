<?php

namespace App\Http\Controllers\Institution\ExchangeRate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('institutions.exchange_rates.index');
    }
}
