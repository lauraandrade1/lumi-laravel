<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::ativos();

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $materiais = $query->latest()->paginate(12);

        return view('materiais.index', compact('materiais'));
    }

    public function show(int $id)
    {
        $material = Material::ativos()->findOrFail($id);
        $material->increment('visualizacoes');

        return view('materiais.show', compact('material'));
    }
}
