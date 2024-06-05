<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Antrian extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function perkalian(){
        return view('perkalian');
    }
    public function perkalian2(Request $r){
        $a=$r->a;
        $b=$r->b;
        $hasil= $a*$b;
        return view('perkalian')
        ->with('hasil', $hasil) 
        ->with('a', $a) 
        ->with('b', $b) ;
    }
    
    public function berita(Request $r){
    $idberita= $r->idberita;
    $judul= $r->judul;

    return view ('berita')
        ->with('idberita',$idberita)
        ->with('judul',$judul)
        ;
}

}
