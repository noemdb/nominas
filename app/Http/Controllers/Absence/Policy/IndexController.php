<?php

namespace App\Http\Controllers\Absence\Policy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('absences.policies.index');
    }
}
