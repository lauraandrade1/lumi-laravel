<?php

namespace App\Http\Controllers;

use App\Models\EntradaDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entradas = EntradaDiario::where('usuario_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('diario.index', compact('entradas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nivel_humor'  => ['required', 'integer', 'min:1', 'max:5'],
            'conteudo'     => ['required', 'string', 'min:5'],
            'emocoes_tags' => ['nullable', 'array'],
        ], [
            'nivel_humor.required' => 'Selecione como você está se sentindo.',
            'conteudo.required'    => 'Escreva algo no diário.',
            'conteudo.min'         => 'Escreva pelo menos 5 caracteres.',
        ]);

        EntradaDiario::create([
            'usuario_id'   => Auth::id(),
            'nivel_humor'  => $request->nivel_humor,
            'conteudo'     => $request->conteudo,
            'emocoes_tags' => $request->emocoes_tags ?? [],
        ]);

        return redirect()->route('diario.index')
            ->with('success', 'Entrada salva com sucesso! 💜');
    }

    public function edit(int $id)
    {
        $entrada = EntradaDiario::where('usuario_id', Auth::id())->findOrFail($id);
        return view('diario.edit', compact('entrada'));
    }

    public function update(Request $request, int $id)
    {
        $entrada = EntradaDiario::where('usuario_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nivel_humor' => ['required', 'integer', 'min:1', 'max:5'],
            'conteudo'    => ['required', 'string', 'min:5'],
        ]);

        $entrada->update($request->only('nivel_humor', 'conteudo', 'emocoes_tags'));

        return redirect()->route('diario.index')
            ->with('success', 'Entrada atualizada! 💜');
    }

    public function destroy(int $id)
    {
        $entrada = EntradaDiario::where('usuario_id', Auth::id())->findOrFail($id);
        $entrada->delete();

        return redirect()->route('diario.index')
            ->with('success', 'Entrada removida.');
    }
}
