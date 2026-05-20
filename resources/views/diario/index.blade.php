@extends('layouts.app')
@section('title', 'Diário Emocional')

@section('content')
<div style="max-width:900px; margin:3rem auto; padding:0 1.5rem">

    <div style="text-align:center; margin-bottom:3rem">
        <h1 class="section-title">Seu Diário Emocional</h1>
        <p class="section-subtitle" style="margin-bottom:0">
            Um espaço privado para registrar seus pensamentos e sentimentos. Seus dados são seus.
        </p>
    </div>

    {{-- NOVA ENTRADA ──────────────────────────────────────── --}}
    <div class="card" style="margin-bottom:2.5rem">
        <div class="card-header">
            <h3 style="color:var(--roxo-escuro); display:flex; align-items:center; gap:.5rem">
                <i class="fas fa-pen-to-square" style="color:var(--roxo-principal)"></i>
                Nova Entrada
            </h3>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('diario.store') }}" method="POST">
                @csrf

                {{-- Humor --}}
                <div class="form-group">
                    <label>Como você está se sentindo hoje? *</label>
                    <div class="humor-chips">
                        @foreach([1=>'😢 Muito Triste',2=>'😕 Triste',3=>'😐 Neutro',4=>'😊 Feliz',5=>'😄 Muito Feliz'] as $val => $label)
                        <button type="button" class="humor-chip {{ old('nivel_humor')==$val?'selected':'' }}" data-val="{{ $val }}">
                            {{ $label }}
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="nivel_humor" name="nivel_humor" value="{{ old('nivel_humor') }}">
                    @error('nivel_humor')<span class="error-msg" style="margin-top:.4rem"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                {{-- Tags de emoção --}}
                <div class="form-group">
                    <label>Emoções que você está sentindo (opcional)</label>
                    <div style="display:flex; gap:.5rem; flex-wrap:wrap">
                        @foreach(['Ansioso','Esperançoso','Cansado','Grato','Frustrado','Calmo','Animado','Sobrecarregado','Saudoso','Motivado'] as $tag)
                        <button type="button" class="emocao-tag-btn humor-chip" data-tag="{{ $tag }}"
                            style="font-size:.82rem; padding:.3rem .8rem">
                            {{ $tag }}
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="emocoes_tags_input" name="emocoes_tags" value="[]">
                </div>

                {{-- Texto --}}
                <div class="form-group">
                    <label for="conteudo">O que está na sua mente? *</label>
                    <textarea id="conteudo" name="conteudo" class="form-textarea @error('conteudo') is-invalid @enderror"
                        rows="6" required
                        placeholder="Escreva sobre seu dia, sentimentos, pensamentos... Este é um espaço seguro para expressar o que está em sua mente.">{{ old('conteudo') }}</textarea>
                    @error('conteudo')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <button type="reset" class="btn btn-ghost">
                        <i class="fas fa-eraser"></i> Limpar
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-floppy-disk"></i> Salvar Entrada
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ENTRADAS ANTERIORES ──────────────────────────────── --}}
    <h3 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro); margin-bottom:1.25rem">
        <i class="fas fa-clock-rotate-left" style="color:var(--roxo-principal)"></i>
        Entradas Anteriores
    </h3>

    @if($entradas->isEmpty())
    <div style="text-align:center; padding:3rem; color:var(--cinza-600); background:var(--branco); border-radius:var(--raio-lg); border:1px solid var(--roxo-palido)">
        <div style="font-size:3.5rem; margin-bottom:.75rem; opacity:.3">📖</div>
        <p>Você ainda não tem entradas no diário. Comece escrevendo acima!</p>
    </div>
    @else
    @foreach($entradas as $entrada)
    <div class="journal-entry-card" style="border-left-color: {{ $entrada->humor_color }}">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:.75rem">
            <div>
                <span style="font-size:1.2rem">{{ $entrada->humor_label }}</span>
                @if($entrada->emocoes_tags)
                <div style="display:flex; gap:.4rem; flex-wrap:wrap; margin-top:.4rem">
                    @foreach($entrada->emocoes_tags as $tag)
                    <span class="badge badge-purple" style="font-size:.72rem">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
            </div>
            <div style="display:flex; align-items:center; gap:.75rem">
                <span style="font-size:.82rem; color:var(--cinza-600)">
                    <i class="fas fa-calendar"></i>
                    {{ $entrada->created_at->format('d/m/Y') }}
                    {{ $entrada->created_at->format('H:i') }}
                </span>
                <div style="display:flex; gap:.4rem">
                    <a href="{{ route('diario.edit', $entrada->id) }}" class="btn btn-ghost btn-sm" title="Editar">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('diario.destroy', $entrada->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                            data-confirm="Excluir esta entrada do diário?">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <p style="color:var(--cinza-800); line-height:1.7; white-space:pre-line">{{ Str::limit($entrada->conteudo, 300) }}</p>
        @if(strlen($entrada->conteudo) > 300)
        <a href="{{ route('diario.edit', $entrada->id) }}" style="font-size:.85rem; color:var(--roxo-principal)">Ler completo →</a>
        @endif
    </div>
    @endforeach

    <div>{{ $entradas->links() }}</div>
    @endif
</div>
@endsection
