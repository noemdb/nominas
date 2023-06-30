<?php

namespace App\Http\Controllers\Employee\PreviousWork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //previous_works
    public function index()
    {
        return view('employees.previous_works.index');
    }
}
