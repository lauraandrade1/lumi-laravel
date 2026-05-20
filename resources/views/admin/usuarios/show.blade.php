@extends('layouts.admin')
@section('title', 'Ver Usuário')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header" style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); text-align:center; padding:2rem">
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; color:var(--branco); margin:0 auto .75rem">
                {{ strtoupper(substr($usuario->nome,0,1)) }}
            </div>
            <h2 style="color:var(--branco); font-family:var(--fonte-titulo)">{{ $usuario->nome }}</h2>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
                <div><span style="font-size:.8rem; color:var(--cinza-600)">E-mail</span><br><strong>{{ $usuario->email }}</strong></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Tipo</span><br><span class="badge {{ $usuario->tipo=='admin'?'badge-purple':'badge-gray' }}">{{ ucfirst($usuario->tipo) }}</span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Status</span><br><span class="badge {{ $usuario->ativo?'badge-green':'badge-red' }}">{{ $usuario->ativo?'Ativo':'Inativo' }}</span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Cadastrado em</span><br><strong>{{ $usuario->created_at->format('d/m/Y H:i') }}</strong></div>
                @if($usuario->telefone)<div><span style="font-size:.8rem; color:var(--cinza-600)">Telefone</span><br><strong>{{ $usuario->telefone }}</strong></div>@endif
                @if($usuario->data_nascimento)<div><span style="font-size:.8rem; color:var(--cinza-600)">Nascimento</span><br><strong>{{ $usuario->data_nascimento->format('d/m/Y') }}</strong></div>@endif
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Editar</a>
                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este usuário?"><i class="fas fa-trash"></i> Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
