@extends('layouts.app')
@section('title', 'Início')

@section('content')
{{-- HERO ──────────────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-content">
        <h1 class="fade-in-up">Seu refúgio para o<br>bem-estar emocional</h1>
        <p class="fade-in-up delay-1">Um espaço seguro para cuidar da sua saúde mental com ferramentas de autoajuda, profissionais qualificados e uma comunidade acolhedora.</p>
        <div class="hero-btns fade-in-up delay-2">

            <a href="{{ route('diario.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-book-heart"></i> Começar Diário
            </a>
            <a href="{{ route('exercicios.index') }}" class="btn btn-secondary btn-lg"> <i class="fas fa-spa"></i> Explorar Exercícios
            </a>
        </div>
    </div>
</section>

{{-- FEATURES ──────────────────────────────────────────────────────────── --}}
<div class="section">
    <h2 class="section-title">Como podemos ajudar</h2>
    <p class="section-subtitle">Ferramentas completas para apoiar sua jornada de autoconhecimento e bem-estar emocional.</p>

    <div class="features-grid">
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-book-open"></i></div>
            <h3>Diário Emocional</h3>
            <p>Registre seus pensamentos num espaço privado. Acompanhe seu humor e identifique padrões emocionais ao longo do tempo.</p>
            <a href="{{ route('diario.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Acessar →</a>
        </div>
        <div class="feature-card reveal delay-1">
            <div class="feature-icon"><i class="fas fa-spa"></i></div>
            <h3>Exercícios Guiados</h3>
            <p>Técnicas de respiração, meditação e relaxamento para ajudar no gerenciamento do estresse e ansiedade.</p>
            <a href="{{ route('exercicios.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Explorar →</a>
        </div>
        <div class="feature-card reveal delay-2">
            <div class="feature-icon"><i class="fas fa-user-md"></i></div>
            <h3>Rede de Psicólogos</h3>
            <p>Encontre profissionais qualificados parceiros da Lumi. Agende consultas e receba acompanhamento personalizado.</p>
            <a href="{{ route('psicologos.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Ver Psicólogos →</a>
        </div>
        <div class="feature-card reveal delay-3">
            <div class="feature-icon"><i class="fas fa-download"></i></div>
            <h3>Materiais Educativos</h3>
            <p>Artigos, vídeos e workbooks desenvolvidos por especialistas para enriquecer sua jornada de autoconhecimento.</p>
            <a href="{{ route('materiais.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Ver Materiais →</a>
        </div>
    </div>
</div>

{{-- PSICÓLOGOS DESTAQUE ────────────────────────────────────────────────── --}}
@if($psicologos->count())
<div style="background: var(--roxo-muitoclaro); padding: 5rem 1.5rem;">
    <div style="max-width:1280px; margin:0 auto">
        <h2 class="section-title">Nossos Psicólogos em Destaque</h2>
        <p class="section-subtitle">Conheça alguns dos profissionais parceiros da Lumi prontos para te apoiar.</p>
        <div class="psicologos-grid">
            @foreach($psicologos as $p)
            <div class="psicologo-card reveal">
                <div class="psicologo-card-header">
                    <div class="psicologo-avatar">{{ strtoupper(substr($p->nome, 0, 1)) }}</div>
                    <h3 style="color:var(--roxo-escuro); margin-bottom:.3rem">{{ $p->nome }}</h3>
                    <span class="crp-badge"><i class="fas fa-id-card"></i> {{ $p->crp_formatado }}</span>
                </div>
                <div class="psicologo-card-body">
                    <p style="font-size:.9rem; color:var(--cinza-600); margin-bottom:.75rem">{{ Str::limit($p->bio, 100) }}</p>
                    <div style="display:flex; gap:.5rem; flex-wrap:wrap">
                        <span class="badge badge-purple">{{ $p->especialidade }}</span>
                        <span class="badge badge-gray">{{ ucfirst($p->modalidade) }}</span>
                    </div>
                </div>
                <div class="psicologo-card-footer">
                    <a href="{{ route('psicologos.show', $p->id) }}" class="btn btn-primary btn-sm">Ver Perfil</a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top:2rem">
            <a href="{{ route('psicologos.index') }}" class="btn btn-primary btn-lg">Ver Todos os Psicólogos</a>
        </div>
    </div>
</div>
@endif

{{-- SOBRE ─────────────────────────────────────────────────────────────── --}}
<div class="section">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center">
        <div>
            <h2 style="font-family:var(--fonte-titulo); font-size:2rem; color:var(--roxo-escuro); margin-bottom:1.5rem">Sobre a Lumi</h2>
            <p style="margin-bottom:1rem; color:var(--cinza-600)">A Lumi nasceu da necessidade de criar um espaço acessível e acolhedor para o cuidado da saúde mental. Nossa plataforma oferece ferramentas de autoajuda baseadas em evidências científicas.</p>
            <p style="margin-bottom:1rem; color:var(--cinza-600)">Acreditamos que o bem-estar emocional deve ser uma prioridade acessível a todos. Por isso, desenvolvemos recursos para o seu dia a dia, enquanto facilitamos o contato com psicólogos.</p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-primary">Criar conta gratuita</a>
            @endguest
        </div>
        <img src="{{ asset('img/cerebro.jpg') }}" alt="" style="height: 350px;">

    </div>
</div>
@endsection