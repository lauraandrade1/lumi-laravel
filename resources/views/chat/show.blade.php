@extends('layouts.app')
@section('title', 'Conversa')
@section('content')
<div style="max-width:760px;margin:2rem auto;padding:0 1.5rem">
    @php $dest = $chat->destinatario; $userId = auth()->id(); @endphp

    {{-- Header --}}
    <div style="background:var(--branco);border-radius:var(--raio-lg);padding:1.25rem 1.5rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm);display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
        <a href="{{ route('chat.index') }}" style="color:var(--roxo-principal);margin-right:.25rem"><i class="fas fa-arrow-left"></i></a>
        @if($dest && $dest->foto)
            <img src="{{ $dest->foto_url }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid var(--roxo-palido)">
        @else
            <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">
                {{ $dest ? strtoupper(substr($dest->nome,0,1)) : '?' }}
            </div>
        @endif
        <div>
            <div style="font-weight:600;color:var(--roxo-escuro)">{{ $dest?->nome ?? 'Usuário removido' }}</div>
            <span class="badge badge-{{ $chat->destinatario_tipo == 'psicologo' ? 'purple' : 'gray' }}" style="font-size:.68rem">
                {{ $chat->destinatario_tipo == 'psicologo' ? 'Psicólogo(a)' : 'Estudante de Psicologia' }}
            </span>
        </div>
    </div>

    {{-- Mensagens --}}
    <div id="msgBox" style="background:var(--branco);border-radius:var(--raio-lg);padding:1.5rem;border:1px solid var(--roxo-palido);min-height:380px;max-height:500px;overflow-y:auto;margin-bottom:1rem;display:flex;flex-direction:column;gap:.75rem">
        @if($chat->mensagens->isEmpty())
        <div style="text-align:center;color:var(--cinza-500);margin:auto">
            <i class="fas fa-comment-dots" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:.75rem"></i>
            Nenhuma mensagem ainda. Diga olá!
        </div>
        @else
        @foreach($chat->mensagens as $msg)
        @php $isMe = ($msg->remetente_tipo === 'usuario' && $msg->remetente_id == $userId); @endphp
        <div style="display:flex;flex-direction:column;align-items:{{ $isMe ? 'flex-end' : 'flex-start' }}">
            @if(!$isMe)
            <div style="font-size:.72rem;color:var(--cinza-500);margin-bottom:.2rem;padding-left:.25rem">{{ $msg->remetente_nome }}</div>
            @endif
            <div style="max-width:72%;padding:.75rem 1rem;border-radius:{{ $isMe ? '18px 18px 4px 18px' : '18px 18px 18px 4px' }};background:{{ $isMe ? 'var(--roxo-principal)' : 'var(--roxo-muitoclaro)' }};color:{{ $isMe ? '#fff' : 'var(--roxo-escuro)' }};font-size:.9rem;line-height:1.5;word-break:break-word">
                {{ $msg->conteudo }}
            </div>
            <div style="font-size:.68rem;color:var(--cinza-400);margin-top:.2rem;padding:0 .25rem">
                {{ $msg->created_at->format('d/m H:i') }}
            </div>
        </div>
        @endforeach
        @endif
    </div>

    {{-- Input --}}
    @if($errors->has('conteudo'))
    <div class="alert alert-danger" style="margin-bottom:.75rem"><i class="fas fa-triangle-exclamation"></i> {{ $errors->first('conteudo') }}</div>
    @endif
    <form action="{{ route('chat.enviar',$chat->id) }}" method="POST">
        @csrf
        <div style="display:flex;gap:.75rem;align-items:flex-end">
            <textarea name="conteudo" rows="2" placeholder="Digite sua mensagem..." required maxlength="2000"
                style="flex:1;padding:.75rem 1rem;border-radius:var(--raio-lg);border:1.5px solid var(--roxo-palido);font-family:inherit;font-size:.9rem;resize:none;outline:none;transition:border-color .2s"
                onfocus="this.style.borderColor='var(--roxo-principal)'" onblur="this.style.borderColor='var(--roxo-palido)'"
                onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();this.closest('form').submit();}"></textarea>
            <button type="submit" class="btn btn-primary" style="padding:.75rem 1.25rem;border-radius:var(--raio-lg)">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <p style="font-size:.72rem;color:var(--cinza-500);margin-top:.4rem">Enter para enviar · Shift+Enter para nova linha</p>
    </form>
</div>
<script>
    const box = document.getElementById('msgBox');
    if(box) box.scrollTop = box.scrollHeight;
</script>
@endsection
