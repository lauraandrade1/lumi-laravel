@extends('layouts.admin')
@section('title', 'Usuários')

@section('content')
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Usuários</h1>
        <p style="color:var(--cinza-600)">{{ $usuarios->total() }} usuários cadastrados</p>
    </div>
</div>

{{-- Busca --}}
<form method="GET" class="search-bar" style="max-width:400px">
    <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou e-mail..." value="{{ request('busca') }}">
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
</form>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Cadastro</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:.8rem; font-weight:700; flex-shrink:0">
                                {{ strtoupper(substr($u->nome,0,1)) }}
                            </div>
                            <span style="font-weight:500">{{ $u->nome }}</span>
                        </div>
                    </td>
                    <td style="color:var(--cinza-600)">{{ $u->email }}</td>
                    <td style="font-size:.85rem; color:var(--cinza-600)">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td><span class="badge {{ $u->tipo=='admin'?'badge-purple':'badge-gray' }}">{{ ucfirst($u->tipo) }}</span></td>
                    <td><span class="badge {{ $u->ativo?'badge-green':'badge-red' }}">{{ $u->ativo?'Ativo':'Inativo' }}</span></td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.usuarios.show', $u->id) }}" class="btn btn-ghost btn-sm" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.usuarios.edit', $u->id) }}" class="btn btn-ghost btn-sm" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir usuário {{ $u->nome }}?">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum usuário encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div>{{ $usuarios->withQueryString()->links() }}</div>
@endsection
