@extends('layouts.app')
@section('title', 'Exercícios Guiados')

@section('content')
<div style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); padding:4rem 1.5rem; text-align:center">
    <h1 style="font-family:var(--fonte-titulo); color:var(--branco); font-size:2.5rem; margin-bottom:.75rem">
        Exercícios Guiados
    </h1>
    <p style="color:rgba(255,255,255,.8); max-width:550px; margin:0 auto; font-size:1.05rem">
        Técnicas de respiração, meditação e relaxamento desenvolvidas para ajudar no gerenciamento do estresse e ansiedade.
    </p>
</div>

<div class="exercicios-section">

    @if($exercicios->isEmpty())
    <div style="text-align:center; padding:4rem; color:var(--cinza-600)">
        <div style="font-size:4rem; margin-bottom:1rem; opacity:.3">🧘</div>
        <p>Nenhum exercício disponível no momento. Volte em breve!</p>
    </div>
    @else
    @foreach($exercicios as $categoria => $lista)
    <div style="margin-bottom:3rem">
        @php
            $icones = ['respiracao'=>'fas fa-wind','meditacao'=>'fas fa-om','relaxamento'=>'fas fa-spa','mindfulness'=>'fas fa-brain','outro'=>'fas fa-star'];
            $labels = ['respiracao'=>'Respiração','meditacao'=>'Meditação','relaxamento'=>'Relaxamento','mindfulness'=>'Mindfulness','outro'=>'Outros'];
        @endphp
        <div class="categoria-label">
            <i class="{{ $icones[$categoria] ?? 'fas fa-star' }}" style="color:var(--roxo-principal)"></i>
            {{ $labels[$categoria] ?? ucfirst($categoria) }}
        </div>

        <div style="display:grid; gap:1.25rem; grid-template-columns:repeat(auto-fill,minmax(320px,1fr))">
            @foreach($lista as $ex)
            <div class="exercicio-card">
                <div style="display:flex; align-items:flex-start; gap:1rem">
                    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:1.2rem; flex-shrink:0">
                        <i class="{{ $ex->icone }}"></i>
                    </div>
                    <div style="flex:1">
                        <h4 style="color:var(--roxo-escuro); margin-bottom:.3rem">{{ $ex->titulo }}</h4>
                        <p style="font-size:.88rem; color:var(--cinza-600); margin-bottom:.75rem">{{ $ex->descricao }}</p>
                        <span class="badge badge-purple">
                            <i class="fas fa-clock"></i> {{ $ex->duracao_minutos }} min
                        </span>

                        @if($ex->passos && count($ex->passos))
                        <details style="margin-top:.75rem">
                            <summary style="cursor:pointer; font-size:.88rem; font-weight:600; color:var(--roxo-principal)">
                                Ver passo a passo
                            </summary>
                            <ol style="margin-top:.5rem; padding-left:1.25rem; font-size:.88rem; color:var(--cinza-600); line-height:2">
                                @foreach($ex->passos as $passo)
                                <li>{{ $passo }}</li>
                                @endforeach
                            </ol>
                        </details>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection
