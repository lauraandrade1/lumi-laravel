@extends('layouts.app')
@section('title', 'Editar Entrada')

@section('content')
<div style="max-width:700px; margin:3rem auto; padding:0 1.5rem">

    <a href="{{ route('diario.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar ao Diário
    </a>

    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen-to-square" style="color:var(--roxo-principal)"></i>
                Editar Entrada
            </h2>
            <p style="color:var(--cinza-600); font-size:.88rem; margin-top:.3rem">
                Criada em {{ $entrada->created_at->format('d/m/Y \à\s H:i') }}
            </p>
        </div>
        <div class="card-body">
            <form action="{{ route('diario.update', $entrada->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Como você estava se sentindo? *</label>
                    <div class="humor-chips">
                        @foreach([1=>'😢 Muito Triste',2=>'😕 Triste',3=>'😐 Neutro',4=>'😊 Feliz',5=>'😄 Muito Feliz'] as $val => $label)
                        <button type="button" class="humor-chip {{ $entrada->nivel_humor==$val?'selected':'' }}" data-val="{{ $val }}">
                            {{ $label }}
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="nivel_humor" name="nivel_humor" value="{{ $entrada->nivel_humor }}">
                </div>

                <div class="form-group">
                    <label for="conteudo">Texto *</label>
                    <textarea id="conteudo" name="conteudo" class="form-textarea" rows="8" required>{{ $entrada->conteudo }}</textarea>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center">
                    <form action="{{ route('diario.destroy', $entrada->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            data-confirm="Excluir esta entrada permanentemente?">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
                    </form>
                    <div style="display:flex; gap:1rem">
                        <a href="{{ route('diario.index') }}" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-floppy-disk"></i> Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
