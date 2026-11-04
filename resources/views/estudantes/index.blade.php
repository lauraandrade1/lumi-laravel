@extends('layouts.app')
@section('title', 'Estudantes de Psicologia')
@section('content')
<div class="section">
    <h2 class="section-title">Estudantes de Psicologia Parceiros</h2>
    <p class="section-subtitle">Estudantes em formação, supervisionados por profissionais, prontos para oferecer apoio emocional acessível.</p>

    <form method="GET" action="{{ route('estudantes.index') }}" style="background:var(--branco);border-radius:var(--raio-lg);padding:1.5rem;margin-bottom:2rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm)">
        <div style="display:grid;grid-template-columns:2fr 1fr 1fr auto;gap:1rem;align-items:end">
            <div class="form-group" style="margin:0">
                <label>Buscar</label>
                <input type="text" name="busca" class="form-control" placeholder="Nome, área ou cidade..." value="{{ request('busca') }}">
            </div>
            <div class="form-group" style="margin:0">
                <label>Área</label>
                <select name="area" class="form-select">
                    <option value="">Todas</option>
                    @foreach($areas as $a)
                    <option value="{{ $a }}" {{ request('area')==$a?'selected':'' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin:0">
                <label>Modalidade</label>
                <select name="modalidade" class="form-select">
                    <option value="">Todas</option>
                    <option value="online"     {{ request('modalidade')=='online'?'selected':'' }}>Online</option>
                    <option value="presencial" {{ request('modalidade')=='presencial'?'selected':'' }}>Presencial</option>
                    <option value="ambos"      {{ request('modalidade')=='ambos'?'selected':'' }}>Ambos</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
        </div>
    </form>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
        <p style="color:var(--cinza-600);font-size:.92rem">{{ $estudantes->total() }} estudantes encontrados</p>
        <a href="{{ route('estudantes.create') }}" class="btn btn-secondary">
            <i class="fas fa-graduation-cap"></i> Cadastrar-se como Estudante
        </a>
    </div>

    @if($estudantes->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--cinza-600)">
        <div style="font-size:4rem;margin-bottom:1rem;opacity:.3">🎓</div>
        <h3 style="margin-bottom:.5rem">Nenhum estudante encontrado</h3>
        <p>Tente ajustar os filtros de busca.</p>
    </div>
    @else
    <div class="psicologos-grid">
        @foreach($estudantes as $e)
        <div class="psicologo-card">
            <div class="psicologo-card-header">
                @if($e->foto)
                    <img src="{{ $e->foto_url }}" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid var(--roxo-palido);margin-bottom:.75rem">
                @else
                    <div class="psicologo-avatar">{{ strtoupper(substr($e->nome,0,1)) }}</div>
                @endif
                <h3 style="color:var(--roxo-escuro);margin-bottom:.3rem">{{ $e->nome }}</h3>
                <span class="badge badge-purple"><i class="fas fa-graduation-cap"></i> {{ $e->semestre }}</span>
            </div>
            <div class="psicologo-card-body">
                <p style="font-size:.85rem;color:var(--cinza-500);margin-bottom:.4rem"><i class="fas fa-university" style="color:var(--roxo-principal)"></i> {{ $e->instituicao }}</p>
                <p style="font-size:.9rem;color:var(--cinza-600);margin-bottom:.75rem">{{ Str::limit($e->bio, 110) }}</p>
                <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.75rem">
                    <span class="badge badge-purple"><i class="fas fa-brain"></i> {{ $e->area_estudo }}</span>
                    <span class="badge badge-gray">{{ ucfirst($e->modalidade) }}</span>
                </div>
                @if($e->cidade)
                <p style="font-size:.85rem;color:var(--cinza-600)"><i class="fas fa-map-marker-alt" style="color:var(--roxo-principal)"></i> {{ $e->cidade }}, {{ $e->estado }}</p>
                @endif
            </div>
            <div class="psicologo-card-footer" style="display:flex;gap:.5rem">
                <a href="{{ route('estudantes.show',$e->id) }}" class="btn btn-primary btn-sm">Ver Perfil</a>
                @auth
                <form action="{{ route('chat.abrir') }}" method="POST" style="display:inline">
                    @csrf
                    <input type="hidden" name="destinatario_id" value="{{ $e->id }}">
                    <input type="hidden" name="destinatario_tipo" value="estudante">
                    <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-comment"></i> Chat</button>
                </form>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    <div>{{ $estudantes->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
