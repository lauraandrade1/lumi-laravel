@extends('layouts.admin')
@section('title', $psicologo->nome)

@section('content')
<div style="max-width:720px">
    <a href="{{ route('admin.psicologos.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header" style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); text-align:center; padding:2rem">
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; color:var(--branco); margin:0 auto .75rem">
                {{ strtoupper(substr($psicologo->nome,0,1)) }}
            </div>
            <h2 style="color:var(--branco); font-family:var(--fonte-titulo); margin-bottom:.4rem">{{ $psicologo->nome }}</h2>
            <span style="background:rgba(255,255,255,.2); color:var(--branco); padding:.25rem .75rem; border-radius:50px; font-size:.85rem; font-weight:600">
                CRP {{ $psicologo->crp_formatado }}
            </span>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem">
                <div><span style="font-size:.8rem; color:var(--cinza-600)">E-mail</span><br><strong>{{ $psicologo->email }}</strong></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Especialidade</span><br><span class="badge badge-purple">{{ $psicologo->especialidade }}</span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Status</span><br>
                    @if($psicologo->isPendente()) <span class="badge badge-yellow">⏳ Pendente</span>
                    @elseif($psicologo->isAprovado()) <span class="badge badge-green">✅ Aprovado</span>
                    @else <span class="badge badge-red">❌ Rejeitado</span>
                    @endif
                </div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Modalidade</span><br><strong>{{ ucfirst($psicologo->modalidade) }}</strong></div>
                @if($psicologo->cidade)<div><span style="font-size:.8rem; color:var(--cinza-600)">Localização</span><br><strong>{{ $psicologo->cidade }}, {{ $psicologo->estado }}</strong></div>@endif
                @if($psicologo->valor_consulta)<div><span style="font-size:.8rem; color:var(--cinza-600)">Valor/sessão</span><br><strong>R$ {{ number_format($psicologo->valor_consulta,2,',','.') }}</strong></div>@endif
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Cadastrado em</span><br><strong>{{ $psicologo->created_at->format('d/m/Y H:i') }}</strong></div>
            </div>

            <div style="margin-bottom:1.5rem">
                <span style="font-size:.8rem; color:var(--cinza-600)">Biografia</span>
                <p style="margin-top:.3rem; line-height:1.7; color:var(--cinza-800)">{{ $psicologo->bio }}</p>
            </div>

            <div style="display:flex; gap:.75rem; flex-wrap:wrap">
                @if($psicologo->isPendente())
                <form action="{{ route('admin.psicologos.aprovar', $psicologo->id) }}" method="POST" style="display:inline">
                    @csrf
                    <input type="hidden" name="acao" value="aprovado">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Aprovar</button>
                </form>
                <form action="{{ route('admin.psicologos.aprovar', $psicologo->id) }}" method="POST" style="display:inline">
                    @csrf
                    <input type="hidden" name="acao" value="rejeitado">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-xmark"></i> Rejeitar</button>
                </form>
                @endif
                <a href="{{ route('admin.psicologos.edit', $psicologo->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i> Editar</a>
                <form action="{{ route('admin.psicologos.destroy', $psicologo->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este psicólogo?"><i class="fas fa-trash"></i> Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
