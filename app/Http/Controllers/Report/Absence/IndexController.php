<?php

namespace App\Http\Controllers\Report\Absence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('reports.absences.index');
    }
}
