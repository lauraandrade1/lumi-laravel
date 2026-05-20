<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::ativos()->get()->groupBy('categoria');
        return view('exercicios.index', compact('exercicios'));
    }
}
