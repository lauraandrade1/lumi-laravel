@extends('layouts.app')
@section('title', 'Editar Perfil')

@section('content')
<div style="max-width:640px; margin:3rem auto; padding:0 1.5rem">
    <a href="{{ route('usuario.perfil') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar ao Perfil
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar Perfil
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('usuario.update') }}" method="POST">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome completo *</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $usuario->telefone) }}">
                    </div>
                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control"
                            value="{{ old('data_nascimento', $usuario->data_nascimento?->format('Y-m-d')) }}">
                    </div>
                </div>

                <hr style="border-color:var(--cinza-400); margin:1.5rem 0">
                <h4 style="color:var(--cinza-800); font-size:.95rem; margin-bottom:1rem">Alterar Senha <span style="font-weight:400; color:var(--cinza-600)">(deixe em branco para manter)</span></h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Mín. 8 caracteres">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem; margin-top:.5rem">
                    <a href="{{ route('usuario.perfil') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Salvar Alterações
                    </button>
                </div>
            </form>

            <hr style="border-color:var(--cinza-400); margin:2rem 0">
            <details>
                <summary style="cursor:pointer; color:var(--vermelho); font-size:.9rem; font-weight:600">
                    <i class="fas fa-triangle-exclamation"></i> Zona de Perigo — Excluir Conta
                </summary>
                <div style="margin-top:1rem; padding:1rem; background:#fef2f2; border-radius:var(--raio); border:1px solid #fecaca">
                    <p style="font-size:.88rem; color:#991b1b; margin-bottom:1rem">Esta ação é irreversível. Todos os seus dados, incluindo entradas do diário, serão excluídos permanentemente.</p>
                    <form action="{{ route('usuario.destroy') }}" method="POST">
                        @csrf @method('DELETE')
                        <div class="form-group">
                            <label style="font-size:.88rem">Confirme sua senha para continuar</label>
                            <input type="password" name="password" class="form-control" required placeholder="Sua senha atual">
                            @error('password')<span class="error-msg">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm"
                            data-confirm="ATENÇÃO: Isso vai excluir sua conta permanentemente. Tem certeza absoluta?">
                            <i class="fas fa-trash"></i> Excluir minha conta
                        </button>
                    </form>
                </div>
            </details>
        </div>
    </div>
</div>
@endsection
