@extends('layouts.admin')
@section('title', 'Estudantes')
@section('content')
<div class="admin-header">
    <h1>Estudantes de Psicologia</h1>
    <p style="color:var(--cinza-600)">{{ $estudantes->total() }} estudantes no total</p>
</div>

<form method="GET" style="display:flex;gap:.75rem;margin-bottom:1.5rem;flex-wrap:wrap;align-items:flex-end">
    <div class="form-group" style="margin:0;flex:1;min-width:200px">
        <input type="text" name="busca" class="form-control" placeholder="Nome ou e-mail..." value="{{ request('busca') }}">
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
    <a href="{{ route('admin.estudantes.index') }}" class="btn btn-ghost">Limpar</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Semestre</th>
                    <th>Área</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($estudantes as $e)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:.6rem">
                            @if($e->foto)
                                <img src="{{ $e->foto_url }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;flex-shrink:0">
                            @else
                                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.8rem;font-weight:700;flex-shrink:0">
                                    {{ strtoupper(substr($e->nome,0,1)) }}
                                </div>
                            @endif
                            <span style="font-weight:500">{{ $e->nome }}</span>
                        </div>
                    </td>
                    <td style="font-size:.85rem;color:var(--cinza-600)">{{ $e->instituicao }}</td>
                    <td><span class="badge badge-gray">{{ $e->semestre }}</span></td>
                    <td><span class="badge badge-purple">{{ $e->area_estudo }}</span></td>
                    <td>
                        @if($e->isPendente())  <span class="badge badge-yellow">⏳ Pendente</span>
                        @elseif($e->isAprovado()) <span class="badge badge-green">✅ Aprovado</span>
                        @else <span class="badge badge-red">❌ Rejeitado</span>
                        @endif
                    </td>
                    <td style="font-size:.85rem;color:var(--cinza-600)">{{ $e->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="table-actions">
                            @if($e->isPendente())
                            <form action="{{ route('admin.estudantes.aprovar',$e->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="acao" value="aprovado">
                                <button type="submit" class="btn btn-primary btn-sm" title="Aprovar"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="{{ route('admin.estudantes.aprovar',$e->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="acao" value="rejeitado">
                                <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar"><i class="fas fa-xmark"></i></button>
                            </form>
                            @endif
                            <form action="{{ route('admin.estudantes.destroy',$e->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir estudante {{ $e->nome }}?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--cinza-600);padding:3rem">Nenhum estudante encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div>{{ $estudantes->withQueryString()->links() }}</div>
@endsection
