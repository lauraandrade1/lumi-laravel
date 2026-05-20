@extends('layouts.app')
@section('title', 'Entrar')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">🧠</div>
        <h1>Bem-vindo de volta</h1>
        <p class="auth-subtitle">Entre na sua conta Lumi</p>

        @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-triangle-exclamation"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="seu@email.com" required autofocus>
                @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Sua senha" required>
            </div>
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem">
                <label style="display:flex; align-items:center; gap:.4rem; font-size:.9rem; cursor:pointer">
                    <input type="checkbox" name="remember"> Lembrar de mim
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-right-to-bracket"></i> Entrar
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; font-size:.92rem; color:var(--cinza-600)">
            Não tem uma conta?
            <a href="{{ route('register') }}" style="font-weight:600">Cadastre-se grátis</a>
        </p>
        <p style="text-align:center; margin-top:.75rem">
            <a href="{{ route('home') }}" style="font-size:.88rem; color:var(--cinza-600)">
                <i class="fas fa-arrow-left"></i> Voltar para o início
            </a>
        </p>
    </div>
</div>
@endsection
