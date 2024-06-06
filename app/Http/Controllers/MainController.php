<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index')
            ->with('content', 'dashboard');
    }
    public function dashboard()
    {
        return view('welcome')->with('content', 'dashboard');
    }
}
