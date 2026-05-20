@extends('layouts.app')
@section('title', 'Cadastro')

@section('content')
<div class="auth-page" style="padding: 3rem 1rem">
    <div class="auth-card" style="max-width:560px">
        <div class="auth-logo">🧠</div>
        <h1>Crie sua conta</h1>
        <p class="auth-subtitle">Junte-se à Lumi — é gratuito!</p>

        @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-triangle-exclamation"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome completo *</label>
                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome') }}" placeholder="Seu nome" required autofocus>
                    @error('nome')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="seu@email.com" required>
                    @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control"
                        value="{{ old('telefone') }}" placeholder="(11) 91234-5678">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento') }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Senha *</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mín. 8 caracteres" required>
                    @error('password')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar senha *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" placeholder="Repita a senha" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top:.5rem">
                <i class="fas fa-user-plus"></i> Criar conta
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; font-size:.92rem; color:var(--cinza-600)">
            Já tem uma conta? <a href="{{ route('login') }}" style="font-weight:600">Faça login</a>
        </p>
        <p style="text-align:center; margin-top:.75rem">
            <a href="{{ route('home') }}" style="font-size:.88rem; color:var(--cinza-600)">
                <i class="fas fa-arrow-left"></i> Voltar para o início
            </a>
        </p>
    </div>
</div>
@endsection
