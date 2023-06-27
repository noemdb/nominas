<?php

namespace App\Http\Controllers\Employee\Position;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('employees.positions.index');
    }
}
