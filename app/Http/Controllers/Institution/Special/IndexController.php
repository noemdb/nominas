<?php

namespace App\Http\Controllers\Institution\Special;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('institutions.specials.index');
    }
}
