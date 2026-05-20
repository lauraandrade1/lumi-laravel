@extends('layouts.admin')
@section('title', 'Exercícios')

@section('content')
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Exercícios</h1>
        <p style="color:var(--cinza-600)">{{ $exercicios->total() }} exercícios cadastrados</p>
    </div>
    <a href="{{ route('admin.exercicios.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Exercício
    </a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Duração</th>
                    <th>Ordem</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exercicios as $ex)
                <tr>
                    <td><strong>{{ $ex->titulo }}</strong></td>
                    <td><span class="badge badge-purple">{{ ucfirst($ex->categoria) }}</span></td>
                    <td>{{ $ex->duracao_minutos }} min</td>
                    <td>{{ $ex->ordem }}</td>
                    <td><span class="badge {{ $ex->ativo?'badge-green':'badge-red' }}">{{ $ex->ativo?'Ativo':'Inativo' }}</span></td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.exercicios.edit', $ex->id) }}" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.exercicios.destroy', $ex->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)" data-confirm="Excluir exercício {{ $ex->titulo }}?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum exercício cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div>{{ $exercicios->links() }}</div>
@endsection
