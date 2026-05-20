@extends('layouts.app')
@section('title', 'Meu Perfil')

@section('content')
<div style="max-width:700px; margin:3rem auto; padding:0 1.5rem">
    <div class="card" style="margin-bottom:1.5rem">
        <div style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); padding:2.5rem; text-align:center">
            <div style="width:90px; height:90px; border-radius:50%; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:700; color:var(--branco); margin:0 auto .75rem; border:3px solid rgba(255,255,255,.4)">
                {{ strtoupper(substr(Auth::user()->nome, 0, 1)) }}
            </div>
            <h1 style="font-family:var(--fonte-titulo); color:var(--branco); font-size:1.6rem; margin-bottom:.25rem">{{ Auth::user()->nome }}</h1>
            <p style="color:rgba(255,255,255,.75); font-size:.92rem">{{ Auth::user()->email }}</p>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem; margin-bottom:1.5rem">
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.8rem; font-weight:700; color:var(--roxo-principal)">{{ $totalEntradas }}</div>
                    <div style="font-size:.82rem; color:var(--cinza-600)">Entradas no Diário</div>
                </div>
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.8rem; font-weight:700; color:var(--roxo-principal)">
                        {{ Auth::user()->created_at->diffInDays() }}
                    </div>
                    <div style="font-size:.82rem; color:var(--cinza-600)">Dias na Lumi</div>
                </div>
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.8rem; font-weight:700; color:var(--roxo-principal)">
                        {{ $ultimaEntrada ? $ultimaEntrada->humor_label[0] : '—' }}
                    </div>
                    <div style="font-size:.82rem; color:var(--cinza-600)">Último Humor</div>
                </div>
            </div>

            @if(Auth::user()->telefone)
            <p style="color:var(--cinza-600); margin-bottom:.4rem"><i class="fas fa-phone" style="color:var(--roxo-principal); width:18px"></i> {{ Auth::user()->telefone }}</p>
            @endif
            @if(Auth::user()->data_nascimento)
            <p style="color:var(--cinza-600)"><i class="fas fa-calendar" style="color:var(--roxo-principal); width:18px"></i> {{ Auth::user()->data_nascimento->format('d/m/Y') }}</p>
            @endif

            <div style="display:flex; gap:1rem; margin-top:1.5rem">
                <a href="{{ route('usuario.edit') }}" class="btn btn-primary">
                    <i class="fas fa-pen"></i> Editar Perfil
                </a>
                <a href="{{ route('diario.index') }}" class="btn btn-secondary">
                    <i class="fas fa-book-heart"></i> Meu Diário
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
