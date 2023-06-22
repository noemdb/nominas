<?php

namespace App\Http\Controllers\Handbook\SocialBenefit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('handbooks.social-benefits.index');
    }
}
