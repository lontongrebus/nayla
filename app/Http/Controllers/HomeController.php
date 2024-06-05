<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('app.index');
        }

        public function indexadmin(){
            return view ('welcomemantap');
        }
        
}
