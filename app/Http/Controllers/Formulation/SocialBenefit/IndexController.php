<?php

namespace App\Http\Controllers\Formulation\SocialBenefit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('formulations.social-benefits.index');
    }
}
