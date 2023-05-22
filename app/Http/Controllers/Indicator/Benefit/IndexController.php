<?php

namespace App\Http\Controllers\Indicator\Benefit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('indicators.benefits.index');
    }
}
