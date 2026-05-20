@extends('layouts.admin')
@section('title', 'Editar Material')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.materiais.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar: {{ $material->titulo }}
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.materiais.update', $material->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $material->titulo) }}" required>
                </div>
                <div class="form-group">
                    <label>Tipo *</label>
                    <select name="tipo" class="form-select" required>
                        @foreach(['artigo'=>'Artigo','video'=>'Vídeo','workbook'=>'Workbook','podcast'=>'Podcast'] as $val => $lbl)
                        <option value="{{ $val }}" {{ $material->tipo==$val?'selected':'' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" class="form-textarea" rows="4" required>{{ old('descricao', $material->descricao) }}</textarea>
                </div>
                <div class="form-group">
                    <label>URL do conteúdo</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url', $material->url) }}" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:.5rem; cursor:pointer">
                        <input type="checkbox" name="ativo" value="1" {{ old('ativo', $material->ativo) ? 'checked' : '' }}>
                        Material ativo
                    </label>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center">
                    <form action="{{ route('admin.materiais.destroy', $material->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este material?"><i class="fas fa-trash"></i> Excluir</button>
                    </form>
                    <div style="display:flex; gap:1rem">
                        <a href="{{ route('admin.materiais.index') }}" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
