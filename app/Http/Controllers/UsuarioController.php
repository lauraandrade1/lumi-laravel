<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    public function show()
    {
        $usuario = Auth::user();
        $totalEntradas = $usuario->entradasDiario()->count();
        $ultimaEntrada = $usuario->entradasDiario()->latest()->first();

        return view('usuario.perfil', compact('usuario', 'totalEntradas', 'ultimaEntrada'));
    }

    public function edit()
    {
        $usuario = Auth::user();
        return view('usuario.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nome'            => ['required', 'string', 'min:3', 'max:100'],
            'email'           => ['required', 'email', 'unique:usuarios,email,' . $usuario->id],
            'telefone'        => ['nullable', 'string', 'max:20'],
            'data_nascimento' => ['nullable', 'date', 'before:today'],
            'password'        => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'nome.required'  => 'O nome é obrigatório.',
            'email.unique'   => 'Este e-mail já está em uso.',
        ]);

        $dados = $request->only('nome', 'email', 'telefone', 'data_nascimento');

        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $usuario->update($dados);

        return redirect()->route('usuario.perfil')
            ->with('success', 'Perfil atualizado com sucesso! 💜');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $usuario = Auth::user();

        if (! Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['password' => 'Senha incorreta.']);
        }

        Auth::logout();
        $usuario->delete();

        return redirect()->route('home')
            ->with('success', 'Sua conta foi removida. Esperamos te ver de volta em breve.');
    }
}
