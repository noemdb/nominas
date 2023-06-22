<?php

namespace App\Http\Controllers\Report\Scheduled;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('reports.scheduleds.index');
    }
}
