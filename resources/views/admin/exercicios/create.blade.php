@extends('layouts.admin')
@section('title', 'Novo Exercício')

@section('content')
<div style="max-width:640px">
    <a href="{{ route('admin.exercicios.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-plus" style="color:var(--roxo-principal)"></i> Novo Exercício
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.exercicios.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required placeholder="Ex: Respiração 4-7-8">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Categoria *</label>
                        <select name="categoria" class="form-select" required>
                            <option value="">Selecione...</option>
                            <option value="respiracao"  {{ old('categoria')=='respiracao' ?'selected':'' }}>Respiração</option>
                            <option value="meditacao"   {{ old('categoria')=='meditacao'  ?'selected':'' }}>Meditação</option>
                            <option value="relaxamento" {{ old('categoria')=='relaxamento'?'selected':'' }}>Relaxamento</option>
                            <option value="mindfulness" {{ old('categoria')=='mindfulness'?'selected':'' }}>Mindfulness</option>
                            <option value="outro"       {{ old('categoria')=='outro'      ?'selected':'' }}>Outro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Duração (minutos) *</label>
                        <input type="number" name="duracao_minutos" class="form-control" value="{{ old('duracao_minutos', 5) }}" required min="1" max="120">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Ícone (FontAwesome)</label>
                        <input type="text" name="icone" class="form-control" value="{{ old('icone', 'fa-spa') }}" placeholder="fa-spa">
                        <span class="help-text">Ex: fa-wind, fa-om, fa-heart</span>
                    </div>
                    <div class="form-group">
                        <label>Ordem de exibição</label>
                        <input type="number" name="ordem" class="form-control" value="{{ old('ordem', 0) }}" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" class="form-textarea" rows="4" required placeholder="Descreva o exercício e seus benefícios...">{{ old('descricao') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Passo a passo <span style="font-weight:400; color:var(--cinza-600)">(um passo por linha)</span></label>
                    <textarea name="passos_texto" class="form-textarea" rows="5" placeholder="Inspire pelo nariz por 4 segundos&#10;Segure a respiração por 7 segundos&#10;Expire pela boca por 8 segundos">{{ old('passos_texto') }}</textarea>
                    <span class="help-text">Cada linha se tornará um passo numerado</span>
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:.5rem; cursor:pointer">
                        <input type="checkbox" name="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}>
                        Exercício ativo (visível no site)
                    </label>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <a href="{{ route('admin.exercicios.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Criar Exercício</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
