@extends('layouts.admin')
@section('title', 'Novo Material')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.materiais.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-plus" style="color:var(--roxo-principal)"></i> Novo Material
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.materiais.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
                </div>
                <div class="form-group">
                    <label>Tipo *</label>
                    <select name="tipo" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="artigo"   {{ old('tipo')=='artigo'  ?'selected':'' }}>Artigo</option>
                        <option value="video"    {{ old('tipo')=='video'   ?'selected':'' }}>Vídeo</option>
                        <option value="workbook" {{ old('tipo')=='workbook'?'selected':'' }}>Workbook</option>
                        <option value="podcast"  {{ old('tipo')=='podcast' ?'selected':'' }}>Podcast</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" class="form-textarea" rows="4" required placeholder="Descreva o conteúdo do material...">{{ old('descricao') }}</textarea>
                </div>
                <div class="form-group">
                    <label>URL do conteúdo</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://...">
                    <span class="help-text">Link externo para o conteúdo (artigo, vídeo, etc.)</span>
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:.5rem; cursor:pointer">
                        <input type="checkbox" name="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}>
                        Material ativo (visível no site)
                    </label>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <a href="{{ route('admin.materiais.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Criar Material</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
