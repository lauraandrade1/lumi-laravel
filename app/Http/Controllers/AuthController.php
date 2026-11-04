<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Psicologo;
use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()  { return view('auth.login'); }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ],[
            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        $email    = $request->email;
        $password = $request->password;

        // ── 1. Tenta como Usuário comum ──────────────────────────────────────
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            if (Auth::user()->isAdmin())
                return redirect()->route('admin.dashboard');
            return redirect()->intended(route('home'))
                ->with('success', 'Bem-vindo de volta, ' . Auth::user()->nome . '! 💜');
        }

        // ── 2. Tenta como Psicólogo ──────────────────────────────────────────
        $psicologo = Psicologo::where('email', $email)->first();
        if ($psicologo && Hash::check($password, $psicologo->password)) {
            if ($psicologo->status === 'pendente') {
                return back()->withErrors([
                    'email' => 'Sua candidatura ainda está sendo analisada. Aguarde a aprovação da equipe Lumi.'
                ])->onlyInput('email');
            }
            if ($psicologo->status === 'rejeitado') {
                return back()->withErrors([
                    'email' => 'Sua candidatura foi rejeitada. Entre em contato com a equipe Lumi.'
                ])->onlyInput('email');
            }
            // Aprovado — loga como usuário temporário usando session
            $request->session()->regenerate();
            $request->session()->put('profissional_tipo', 'psicologo');
            $request->session()->put('profissional_id', $psicologo->id);
            $request->session()->put('profissional_nome', $psicologo->nome);
            // Loga também no guard padrão criando/buscando usuário espelho
            $usuario = Usuario::firstOrCreate(
                ['email' => $psicologo->email],
                [
                    'nome'     => $psicologo->nome,
                    'password' => $psicologo->password,
                    'tipo'     => 'usuario',
                    'ativo'    => true,
                ]
            );
            Auth::login($usuario, $request->boolean('remember'));
            return redirect()->intended(route('home'))
                ->with('success', 'Bem-vindo de volta, ' . $psicologo->nome . '! 💜');
        }

        // ── 3. Tenta como Estudante ──────────────────────────────────────────
        $estudante = Estudante::where('email', $email)->first();
        if ($estudante && Hash::check($password, $estudante->password)) {
            if ($estudante->status === 'pendente') {
                return back()->withErrors([
                    'email' => 'Sua candidatura ainda está sendo analisada. Aguarde a aprovação da equipe Lumi.'
                ])->onlyInput('email');
            }
            if ($estudante->status === 'rejeitado') {
                return back()->withErrors([
                    'email' => 'Sua candidatura foi rejeitada. Entre em contato com a equipe Lumi.'
                ])->onlyInput('email');
            }
            // Aprovado — loga
            $request->session()->regenerate();
            $request->session()->put('profissional_tipo', 'estudante');
            $request->session()->put('profissional_id', $estudante->id);
            $request->session()->put('profissional_nome', $estudante->nome);
            $usuario = Usuario::firstOrCreate(
                ['email' => $estudante->email],
                [
                    'nome'     => $estudante->nome,
                    'password' => $estudante->password,
                    'tipo'     => 'usuario',
                    'ativo'    => true,
                ]
            );
            Auth::login($usuario, $request->boolean('remember'));
            return redirect()->intended(route('home'))
                ->with('success', 'Bem-vindo de volta, ' . $estudante->nome . '! 💜');
        }

        // ── Nenhum encontrado ────────────────────────────────────────────────
        return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->onlyInput('email');
    }

    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
    {
        $request->validate([
            'nome'            => ['required','string','min:3','max:100'],
            'email'           => ['required','email','unique:usuarios,email'],
            'telefone'        => ['nullable','string','max:20'],
            'data_nascimento' => ['nullable','date','before:today'],
            'password'        => ['required','confirmed', Password::min(8)->letters()->numbers()],
            'avatar'          => ['nullable','image','mimes:jpeg,png,webp','max:2048'],
        ],[
            'nome.required'          => 'O nome é obrigatório.',
            'email.unique'           => 'Este e-mail já está cadastrado.',
            'password.confirmed'     => 'As senhas não coincidem.',
            'data_nascimento.before' => 'A data deve ser anterior a hoje.',
            'avatar.image'           => 'O arquivo deve ser uma imagem.',
            'avatar.max'             => 'A imagem deve ter no máximo 2 MB.',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar'))
            $avatarPath = $request->file('avatar')->store('usuarios/avatars','public');

        $usuario = Usuario::create([
            'nome'            => $request->nome,
            'email'           => $request->email,
            'telefone'        => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'password'        => Hash::make($request->password),
            'tipo'            => 'usuario',
            'avatar'          => $avatarPath,
        ]);

        Auth::login($usuario);
        return redirect()->route('home')->with('success','Conta criada com sucesso! Bem-vindo à Lumi 💜');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success','Você saiu com segurança. Até logo! 👋');
    }
}