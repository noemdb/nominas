<?php

namespace App\Http\Controllers\Employee\Documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('employees.documentations.index');
    }
}
