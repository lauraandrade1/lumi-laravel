@extends('layouts.admin')
@section('title', 'Psicólogos')

@section('content')
<div class="admin-header">
    <h1>Psicólogos</h1>
    <p style="color:var(--cinza-600)">{{ $psicologos->total() }} psicólogos no total</p>
</div>

<form method="GET" style="display:flex; gap:.75rem; margin-bottom:1.5rem; flex-wrap:wrap; align-items:flex-end">
    <div class="form-group" style="margin:0; flex:1; min-width:200px">
        <input type="text" name="busca" class="form-control" placeholder="Nome, CRP ou e-mail..." value="{{ request('busca') }}">
    </div>
    <div class="form-group" style="margin:0">
        <select name="status" class="form-select">
            <option value="">Todos os status</option>
            <option value="pendente"  {{ request('status')=='pendente' ?'selected':'' }}>Pendentes</option>
            <option value="aprovado"  {{ request('status')=='aprovado' ?'selected':'' }}>Aprovados</option>
            <option value="rejeitado" {{ request('status')=='rejeitado'?'selected':'' }}>Rejeitados</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
    <a href="{{ route('admin.psicologos.index') }}" class="btn btn-ghost">Limpar</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CRP</th>
                    <th>E-mail</th>
                    <th>Especialidade</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($psicologos as $p)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:.8rem; font-weight:700; flex-shrink:0">
                                {{ strtoupper(substr($p->nome,0,1)) }}
                            </div>
                            <span style="font-weight:500">{{ $p->nome }}</span>
                        </div>
                    </td>
                    <td><span class="crp-badge">{{ $p->crp_formatado }}</span></td>
                    <td style="font-size:.85rem; color:var(--cinza-600)">{{ $p->email }}</td>
                    <td><span class="badge badge-purple">{{ $p->especialidade }}</span></td>
                    <td>
                        @if($p->isPendente())  <span class="badge badge-yellow">⏳ Pendente</span>
                        @elseif($p->isAprovado()) <span class="badge badge-green">✅ Aprovado</span>
                        @else <span class="badge badge-red">❌ Rejeitado</span>
                        @endif
                    </td>
                    <td style="font-size:.85rem; color:var(--cinza-600)">{{ $p->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="table-actions">
                            @if($p->isPendente())
                            <form action="{{ route('admin.psicologos.aprovar', $p->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="acao" value="aprovado">
                                <button type="submit" class="btn btn-primary btn-sm" title="Aprovar"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="{{ route('admin.psicologos.aprovar', $p->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="acao" value="rejeitado">
                                <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar"><i class="fas fa-xmark"></i></button>
                            </form>
                            @endif
                            <a href="{{ route('admin.psicologos.show', $p->id) }}" class="btn btn-ghost btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.psicologos.edit', $p->id) }}" class="btn btn-ghost btn-sm" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.psicologos.destroy', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir psicólogo {{ $p->nome }}?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum psicólogo encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div>{{ $psicologos->withQueryString()->links() }}</div>
@endsection
