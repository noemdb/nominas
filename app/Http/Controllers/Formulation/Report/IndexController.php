<?php

namespace App\Http\Controllers\Formulation\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('formulations.reports.index');
    }
}
