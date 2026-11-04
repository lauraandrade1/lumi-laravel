@extends('layouts.app')
@section('title', $psicologo->nome)
@section('content')
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-body" style="text-align:center;padding:2.5rem">
            @if($psicologo->foto)
                <img src="{{ $psicologo->foto_url }}" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--roxo-palido);margin-bottom:1rem">
            @else
                <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;font-weight:700;margin:0 auto 1rem">
                    {{ strtoupper(substr($psicologo->nome,0,1)) }}
                </div>
            @endif
            <h1 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.8rem;margin-bottom:.4rem">{{ $psicologo->nome }}</h1>
            <span class="crp-badge" style="font-size:.85rem"><i class="fas fa-id-card"></i> CRP {{ $psicologo->crp_formatado }}</span>
        </div>
        <div style="padding:0 2rem 2rem">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:2rem">
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Especialidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ $psicologo->especialidade }}</div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Modalidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ ucfirst($psicologo->modalidade) }}</div>
                </div>
                @if($psicologo->cidade)
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Localização</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">{{ $psicologo->cidade }}, {{ $psicologo->estado }}</div>
                </div>
                @endif
                @if($psicologo->valor_consulta)
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Valor/sessão</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">R$ {{ number_format($psicologo->valor_consulta,2,',','.') }}</div>
                </div>
                @endif
            </div>
            <h3 style="color:var(--roxo-escuro);margin-bottom:.75rem">Sobre</h3>
            <p style="color:var(--cinza-600);line-height:1.8;margin-bottom:2rem">{{ $psicologo->bio }}</p>
            @if($psicologo->telefone)
            <div style="margin-bottom:1.5rem">
                <a href="https://wa.me/55{{ preg_replace('/\D/','',$psicologo->telefone) }}" target="_blank" class="btn btn-secondary btn-lg" style="width:100%;display:block;text-align:center;margin-bottom:.75rem">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
            @endif
            @auth
            <form action="{{ route('chat.abrir') }}" method="POST">
                @csrf
                <input type="hidden" name="destinatario_id" value="{{ $psicologo->id }}">
                <input type="hidden" name="destinatario_tipo" value="psicologo">
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
