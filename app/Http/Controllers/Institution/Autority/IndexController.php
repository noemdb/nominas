<?php

namespace App\Http\Controllers\Institution\Autority;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('institutions.autorities.index');
    }
}
