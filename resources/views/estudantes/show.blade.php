@extends('layouts.app')
@section('title', $estudante->nome)
@section('content')
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-body" style="text-align:center;padding:2.5rem">
            @if($estudante->foto)
                <img src="{{ $estudante->foto_url }}" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--roxo-palido);margin-bottom:1rem">
            @else
                <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;font-weight:700;margin:0 auto 1rem">
                    {{ strtoupper(substr($estudante->nome,0,1)) }}
                </div>
            @endif
            <h1 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.8rem;margin-bottom:.4rem">{{ $estudante->nome }}</h1>
            <span class="badge badge-purple" style="font-size:.85rem"><i class="fas fa-graduation-cap"></i> Estudante de Psicologia</span>
        </div>
        <div style="padding:0 2rem 2rem">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:2rem">
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Instituição</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ $estudante->instituicao }}</div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Semestre</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ $estudante->semestre }}</div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Área de Interesse</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ $estudante->area_estudo }}</div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Modalidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ ucfirst($estudante->modalidade) }}</div>
                </div>
            </div>
            <h3 style="color:var(--roxo-escuro);margin-bottom:.75rem">Apresentação</h3>
            <p style="color:var(--cinza-600);line-height:1.8;margin-bottom:2rem">{{ $estudante->bio }}</p>
            @auth
            <form action="{{ route('chat.abrir') }}" method="POST">
                @csrf
                <input type="hidden" name="destinatario_id" value="{{ $estudante->id }}">
                <input type="hidden" name="destinatario_tipo" value="estudante">
                <button type="submit" class="btn btn-primary btn-lg" style="width:100%">
                    <i class="fas fa-comment"></i> Iniciar Conversa
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="width:100%;display:block;text-align:center">
                <i class="fas fa-sign-in-alt"></i> Faça login para conversar
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection
