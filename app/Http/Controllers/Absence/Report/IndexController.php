<?php

namespace App\Http\Controllers\Absence\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('absences.reports.index');
    }
}
