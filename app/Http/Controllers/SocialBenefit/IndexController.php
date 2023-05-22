<?php

namespace App\Http\Controllers\SocialBenefit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('social-benefits.index');
    }
}
