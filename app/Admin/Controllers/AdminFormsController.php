<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

class AdminFormsController extends Controller
{
    public function index()
    {
        return view('tailAdmin.login');
    }
}
