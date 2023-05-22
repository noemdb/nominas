<?php

namespace App\Http\Controllers\Vacation\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('vacations.registers.index');
    }
}
