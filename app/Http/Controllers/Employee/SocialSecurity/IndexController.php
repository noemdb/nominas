<?php

namespace App\Http\Controllers\Employee\SocialSecurity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('employees.social-security.index');
    }
}
