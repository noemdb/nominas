<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DataManagementController extends Controller
{
    public function data_management(Request $request): View
    {
        return view('data_management', [
            'workers' => Worker::paginate(10),
        ]);
    }
}
