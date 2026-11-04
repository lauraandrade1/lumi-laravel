@extends('layouts.app')
@section('title', 'Minhas Conversas')
@section('content')
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
        <h2 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.6rem"><i class="fas fa-comments" style="color:var(--roxo-principal)"></i> Minhas Conversas</h2>
    </div>

    @if($chats->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--cinza-600)">
        <div style="font-size:4rem;margin-bottom:1rem;opacity:.3">💬</div>
        <h3 style="margin-bottom:.5rem">Nenhuma conversa ainda</h3>
        <p style="margin-bottom:1.5rem">Acesse o perfil de um psicólogo ou estudante para iniciar uma conversa.</p>
        <a href="{{ route('psicologos.index') }}" class="btn btn-primary">Ver Profissionais</a>
    </div>
    @else
    <div style="display:flex;flex-direction:column;gap:.75rem">
        @foreach($chats as $chat)
        @php $dest = $chat->destinatario; $ultima = $chat->ultimaMensagem; @endphp
        <a href="{{ route('chat.show',$chat->id) }}" style="text-decoration:none">
            <div style="background:var(--branco);border-radius:var(--raio-lg);padding:1.25rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm);display:flex;align-items:center;gap:1rem;transition:all .2s"
                onmouseover="this.style.borderColor='var(--roxo-principal)';this.style.boxShadow='var(--sombra-md)'"
                onmouseout="this.style.borderColor='var(--roxo-palido)';this.style.boxShadow='var(--sombra-sm)'">
                @if($dest && $dest->foto)
                    <img src="{{ $dest->foto_url }}" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid var(--roxo-palido);flex-shrink:0">
                @else
                    <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:700;flex-shrink:0">
                        {{ $dest ? strtoupper(substr($dest->nome,0,1)) : '?' }}
                    </div>
                @endif
                <div style="flex:1;min-width:0">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.25rem">
                        <span style="font-weight:600;color:var(--roxo-escuro)">{{ $dest?->nome ?? 'Usuário removido' }}</span>
                        <span style="font-size:.75rem;color:var(--cinza-500)">
                            {{ $ultima ? $ultima->created_at->diffForHumans() : '' }}
                        </span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem">
                        <span class="badge badge-{{ $chat->destinatario_tipo == 'psicologo' ? 'purple' : 'gray' }}" style="font-size:.68rem">
                            {{ $chat->destinatario_tipo == 'psicologo' ? 'Psicólogo(a)' : 'Estudante' }}
                        </span>
                        <span style="font-size:.85rem;color:var(--cinza-600);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                            {{ $ultima ? Str::limit($ultima->conteudo, 60) : 'Nenhuma mensagem ainda' }}
                        </span>
                    </div>
                </div>
                <i class="fas fa-chevron-right" style="color:var(--roxo-claro);flex-shrink:0"></i>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
