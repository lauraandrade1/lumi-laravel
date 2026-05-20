@extends('layouts.admin')
@section('title', 'Editar Exercício')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.exercicios.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar: {{ $exercicio->titulo }}
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.exercicios.update', $exercicio->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $exercicio->titulo) }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Categoria *</label>
                        <select name="categoria" class="form-select" required>
                            @foreach(['respiracao'=>'Respiração','meditacao'=>'Meditação','relaxamento'=>'Relaxamento','mindfulness'=>'Mindfulness','outro'=>'Outro'] as $val => $lbl)
                            <option value="{{ $val }}" {{ $exercicio->categoria==$val?'selected':'' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Duração (min) *</label>
                        <input type="number" name="duracao_minutos" class="form-control" value="{{ old('duracao_minutos', $exercicio->duracao_minutos) }}" required min="1">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Ícone</label>
                        <input type="text" name="icone" class="form-control" value="{{ old('icone', $exercicio->icone) }}">
                    </div>
                    <div class="form-group">
                        <label>Ordem</label>
                        <input type="number" name="ordem" class="form-control" value="{{ old('ordem', $exercicio->ordem) }}" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" class="form-textarea" rows="4" required>{{ old('descricao', $exercicio->descricao) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Passo a passo <span style="font-weight:400; color:var(--cinza-600)">(um passo por linha)</span></label>
                    <textarea name="passos_texto" class="form-textarea" rows="5">{{ old('passos_texto', $exercicio->passos ? implode("\n", $exercicio->passos) : '') }}</textarea>
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:.5rem; cursor:pointer">
                        <input type="checkbox" name="ativo" value="1" {{ old('ativo', $exercicio->ativo) ? 'checked' : '' }}>
                        Exercício ativo
                    </label>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center">
                    <form action="{{ route('admin.exercicios.destroy', $exercicio->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este exercício?"><i class="fas fa-trash"></i> Excluir</button>
                    </form>
                    <div style="display:flex; gap:1rem">
                        <a href="{{ route('admin.exercicios.index') }}" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
