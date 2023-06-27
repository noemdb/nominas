<?php

namespace App\Http\Controllers\Vacation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('vacations.index');
    }
}
