<?php

namespace App\Http\Controllers\Report\ProcessEfficiency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('reports.process-efficiencies.index');
    }
}
