@extends('layouts.admin')
@section('title', 'Materiais')

@section('content')
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Materiais Educativos</h1>
        <p style="color:var(--cinza-600)">{{ $materiais->total() }} materiais cadastrados</p>
    </div>
    <a href="{{ route('admin.materiais.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Material
    </a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Visualizações</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materiais as $m)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <i class="fas {{ $m->tipo_icone }}" style="color:var(--roxo-principal); width:18px"></i>
                            <strong>{{ $m->titulo }}</strong>
                        </div>
                    </td>
                    <td><span class="badge badge-purple">{{ $m->tipo_label }}</span></td>
                    <td style="color:var(--cinza-600)"><i class="fas fa-eye"></i> {{ $m->visualizacoes }}</td>
                    <td><span class="badge {{ $m->ativo?'badge-green':'badge-red' }}">{{ $m->ativo?'Ativo':'Inativo' }}</span></td>
                    <td style="font-size:.85rem; color:var(--cinza-600)">{{ $m->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.materiais.edit', $m->id) }}" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.materiais.destroy', $m->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir material {{ $m->titulo }}?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum material cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div>{{ $materiais->links() }}</div>
@endsection
