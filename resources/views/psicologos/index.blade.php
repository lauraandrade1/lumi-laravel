@extends('layouts.app')
@section('title', 'Psicólogos')

@section('content')
<div class="section">
    <h2 class="section-title">Nossa Rede de Psicólogos</h2>
    <p class="section-subtitle">Profissionais qualificados e aprovados pela equipe Lumi, prontos para te apoiar.</p>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('psicologos.index') }}" style="background:var(--branco); border-radius:var(--raio-lg); padding:1.5rem; margin-bottom:2rem; border:1px solid var(--roxo-palido); box-shadow:var(--sombra-sm)">
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr auto; gap:1rem; align-items:end">
            <div class="form-group" style="margin:0">
                <label>Buscar</label>
                <input type="text" name="busca" class="form-control" placeholder="Nome, especialidade ou cidade..." value="{{ request('busca') }}">
            </div>
            <div class="form-group" style="margin:0">
                <label>Especialidade</label>
                <select name="especialidade" class="form-select">
                    <option value="">Todas</option>
                    @foreach($especialidades as $esp)
                    <option value="{{ $esp }}" {{ request('especialidade')==$esp?'selected':'' }}>{{ $esp }}</option>
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

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
        <p style="color:var(--cinza-600); font-size:.92rem">{{ $psicologos->total() }} profissionais encontrados</p>
        <a href="{{ route('psicologos.create') }}" class="btn btn-secondary">
            <i class="fas fa-user-md"></i> Cadastrar-se como Psicólogo
        </a>
    </div>

    @if($psicologos->isEmpty())
    <div style="text-align:center; padding:4rem; color:var(--cinza-600)">
        <div style="font-size:4rem; margin-bottom:1rem; opacity:.3">👨‍⚕️</div>
        <h3 style="margin-bottom:.5rem">Nenhum psicólogo encontrado</h3>
        <p>Tente ajustar os filtros de busca.</p>
    </div>
    @else
    <div class="psicologos-grid">
        @foreach($psicologos as $p)
        <div class="psicologo-card">
            <div class="psicologo-card-header">
                <div class="psicologo-avatar">{{ strtoupper(substr($p->nome, 0, 1)) }}</div>
                <h3 style="color:var(--roxo-escuro); margin-bottom:.3rem">{{ $p->nome }}</h3>
                <span class="crp-badge"><i class="fas fa-id-card"></i> CRP {{ $p->crp_formatado }}</span>
            </div>
            <div class="psicologo-card-body">
                <p style="font-size:.9rem; color:var(--cinza-600); margin-bottom:.75rem">{{ Str::limit($p->bio, 120) }}</p>
                <div style="display:flex; gap:.5rem; flex-wrap:wrap; margin-bottom:.75rem">
                    <span class="badge badge-purple"><i class="fas fa-brain"></i> {{ $p->especialidade }}</span>
                    <span class="badge badge-gray">{{ ucfirst($p->modalidade) }}</span>
                </div>
                @if($p->cidade)
                <p style="font-size:.85rem; color:var(--cinza-600)"><i class="fas fa-map-marker-alt" style="color:var(--roxo-principal)"></i> {{ $p->cidade }}, {{ $p->estado }}</p>
                @endif
                @if($p->valor_consulta)
                <p style="font-size:.85rem; color:var(--cinza-600); margin-top:.3rem"><i class="fas fa-tag" style="color:var(--roxo-principal)"></i> R$ {{ number_format($p->valor_consulta, 2, ',', '.') }}/sessão</p>
                @endif
            </div>
            <div class="psicologo-card-footer">
                <a href="{{ route('psicologos.show', $p->id) }}" class="btn btn-primary btn-sm">Ver Perfil</a>
            </div>
        </div>
        @endforeach
    </div>
    <div>{{ $psicologos->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
