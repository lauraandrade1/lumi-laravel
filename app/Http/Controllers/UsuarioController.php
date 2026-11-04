<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    public function show()
    {
        $usuario       = Auth::user();
        $totalEntradas = $usuario->entradasDiario()->count();
        $ultimaEntrada = $usuario->entradasDiario()->latest()->first();
        return view('usuario.perfil', compact('usuario','totalEntradas','ultimaEntrada'));
    }

    public function edit()
    {
        return view('usuario.edit', ['usuario' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();
        $request->validate([
            'nome'            => ['required','string','min:3','max:100'],
            'email'           => ['required','email','unique:usuarios,email,'.$usuario->id],
            'telefone'        => ['nullable','string','max:20'],
            'data_nascimento' => ['nullable','date','before:today'],
            'password'        => ['nullable','confirmed', Password::min(8)->letters()->numbers()],
            'avatar'          => ['nullable','image','mimes:jpeg,png,webp','max:2048'],
        ],[
            'nome.required' => 'O nome é obrigatório.',
            'email.unique'  => 'Este e-mail já está em uso.',
            'avatar.image'  => 'O arquivo deve ser uma imagem.',
            'avatar.max'    => 'A imagem deve ter no máximo 2 MB.',
        ]);

        $dados = $request->only('nome','email','telefone','data_nascimento');

        if ($request->hasFile('avatar')) {
            if ($usuario->avatar) Storage::disk('public')->delete($usuario->avatar);
            $dados['avatar'] = $request->file('avatar')->store('usuarios/avatars','public');
        }

        if ($request->filled('password'))
            $dados['password'] = Hash::make($request->password);

        $usuario->update($dados);
        return redirect()->route('usuario.perfil')->with('success','Perfil atualizado com sucesso! 💜');
    }

    public function destroy(Request $request)
    {
        $request->validate(['password'=>['required']]);
        $usuario = Auth::user();
        if (!Hash::check($request->password,$usuario->password))
            return back()->withErrors(['password'=>'Senha incorreta.']);
        Auth::logout();
        $usuario->delete();
        return redirect()->route('home')->with('success','Sua conta foi removida.');
    }
}
