<?php

namespace App\Http\Controllers\Report\Benefit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('reports.benefits.index');
    }
}
