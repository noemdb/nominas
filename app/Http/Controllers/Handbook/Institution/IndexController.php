<?php

namespace App\Http\Controllers\Handbook\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('handbooks.institutions.index');
    }
}
