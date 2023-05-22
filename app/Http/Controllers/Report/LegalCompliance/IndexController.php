<?php

namespace App\Http\Controllers\Report\LegalCompliance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('reports.legal-compliances.index');
    }
}
