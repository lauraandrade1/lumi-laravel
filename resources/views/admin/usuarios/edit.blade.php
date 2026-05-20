@extends('layouts.admin')
@section('title', 'Editar Usuário')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar Usuário: {{ $usuario->nome }}
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome *</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo *</label>
                        <select name="tipo" class="form-select" required>
                            <option value="usuario" {{ $usuario->tipo=='usuario'?'selected':'' }}>Usuário</option>
                            <option value="admin"   {{ $usuario->tipo=='admin'?'selected':'' }}>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="ativo" class="form-select">
                            <option value="1" {{ $usuario->ativo?'selected':'' }}>Ativo</option>
                            <option value="0" {{ !$usuario->ativo?'selected':'' }}>Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nova Senha <span style="font-weight:400; color:var(--cinza-600)">(deixe vazio para manter)</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (opcional)">
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
