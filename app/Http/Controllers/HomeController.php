<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use App\Models\Material;
use App\Models\Psicologo;

class HomeController extends Controller
{
    public function index()
    {
        $psicologos = Psicologo::aprovados()->take(3)->get();
        $exercicios = Exercicio::ativos()->take(4)->get();

        return view('home.index', compact('psicologos', 'exercicios'));
    }
}
