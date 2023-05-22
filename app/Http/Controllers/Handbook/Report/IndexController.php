<?php

namespace App\Http\Controllers\Handbook\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('handbooks.reports.index');
    }
}
