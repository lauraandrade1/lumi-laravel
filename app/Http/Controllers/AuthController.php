<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ── Login ────────────────────────────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Bem-vindo de volta, ' . Auth::user()->nome . '! 💜');
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha incorretos.',
        ])->onlyInput('email');
    }

    // ── Cadastro ─────────────────────────────────────────────────────────────
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome'              => ['required', 'string', 'min:3', 'max:100'],
            'email'             => ['required', 'email', 'unique:usuarios,email'],
            'telefone'          => ['nullable', 'string', 'max:20'],
            'data_nascimento'   => ['nullable', 'date', 'before:today'],
            'password'          => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'nome.required'           => 'O nome é obrigatório.',
            'nome.min'                => 'O nome deve ter pelo menos 3 caracteres.',
            'email.required'          => 'O e-mail é obrigatório.',
            'email.email'             => 'Informe um e-mail válido.',
            'email.unique'            => 'Este e-mail já está cadastrado.',
            'password.required'       => 'A senha é obrigatória.',
            'password.confirmed'      => 'As senhas não coincidem.',
            'data_nascimento.before'  => 'A data de nascimento deve ser anterior a hoje.',
        ]);

        $usuario = Usuario::create([
            'nome'            => $request->nome,
            'email'           => $request->email,
            'telefone'        => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'password'        => Hash::make($request->password),
            'tipo'            => 'usuario',
        ]);

        Auth::login($usuario);

        return redirect()->route('home')
            ->with('success', 'Conta criada com sucesso! Bem-vindo à Lumi 💜');
    }

    // ── Logout ───────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Você saiu com segurança. Até logo! 👋');
    }
}
