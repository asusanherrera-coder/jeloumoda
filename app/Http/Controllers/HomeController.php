<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function nosotros()
    {
        return view('home.nosotros');
    }

    public function blog()
    {
        return view('home.blog');
    }
    public function terminos()
    {
        return view('home.terminos');
    }
    public function metodosEnvio()
    {
        return view('home.metodos-envio');
    }

    public function politicaPrivacidad()
    {
        return view('home.politica-privacidad');
    }


}