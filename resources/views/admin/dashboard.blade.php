@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="admin-header">
    <h1>Dashboard</h1>
    <p style="color:var(--cinza-600)">Bem-vindo ao painel administrativo da Lumi, {{ Auth::user()->nome }}!</p>
</div>

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">👤</div>
        <div class="stat-value">{{ $stats['usuarios'] }}</div>
        <div class="stat-label">Usuários Cadastrados</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">✅</div>
        <div class="stat-value" style="color:var(--verde)">{{ $stats['psicologos_aprovados'] }}</div>
        <div class="stat-label">Psicólogos Aprovados</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">⏳</div>
        <div class="stat-value" style="color:var(--amarelo)">{{ $stats['psicologos_pendentes'] }}</div>
        <div class="stat-label">Psicólogos Pendentes</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">🎓</div>
        <div class="stat-value" style="color:var(--verde)">{{ $stats['estudantes_aprovados'] }}</div>
        <div class="stat-label">Estudantes Aprovados</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">⏳</div>
        <div class="stat-value" style="color:var(--amarelo)">{{ $stats['estudantes_pendentes'] }}</div>
        <div class="stat-label">Estudantes Pendentes</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">📖</div>
        <div class="stat-value">{{ $stats['entradas_diario'] }}</div>
        <div class="stat-label">Entradas no Diário</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">🧘</div>
        <div class="stat-value">{{ $stats['exercicios'] }}</div>
        <div class="stat-label">Exercícios</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">📚</div>
        <div class="stat-value">{{ $stats['materiais'] }}</div>
        <div class="stat-label">Materiais</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem">

    {{-- Psicólogos pendentes --}}
    <div class="card">
        <div class="card-header" style="display:flex; align-items:center; justify-content:space-between">
            <h3 style="color:var(--roxo-escuro)">
                <i class="fas fa-user-md" style="color:var(--amarelo)"></i> Psicólogos Pendentes
            </h3>
            <a href="{{ route('admin.psicologos.index', ['status'=>'pendente']) }}" class="btn btn-ghost btn-sm">Ver todos</a>
        </div>
        <div class="card-body" style="padding:0">
            @forelse($psicologosPendentes as $p)
            <div style="padding:1rem 1.5rem; border-bottom:1px solid var(--cinza-200); display:flex; align-items:center; justify-content:space-between">
                <div style="display:flex; align-items:center; gap:.75rem">
                    @if($p->foto)
                        <img src="{{ $p->foto_url }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0">
                    @else
                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.85rem;font-weight:700;flex-shrink:0">
                            {{ strtoupper(substr($p->nome,0,1)) }}
                        </div>
                    @endif
                    <div>
                        <div style="font-weight:600; color:var(--cinza-800)">{{ $p->nome }}</div>
                        <div style="font-size:.78rem; color:var(--cinza-600)">CRP {{ $p->crp }} · {{ $p->especialidade }}</div>
                    </div>
                </div>
                <div style="display:flex; gap:.4rem">
                    <form action="{{ route('admin.psicologos.aprovar', $p->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="acao" value="aprovado">
                        <button type="submit" class="btn btn-primary btn-sm" title="Aprovar"><i class="fas fa-check"></i></button>
                    </form>
                    <form action="{{ route('admin.psicologos.aprovar', $p->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="acao" value="rejeitado">
                        <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar"><i class="fas fa-xmark"></i></button>
                    </form>
                </div>
            </div>
            @empty
            <div style="padding:2rem; text-align:center; color:var(--cinza-600); font-size:.92rem">
                <i class="fas fa-circle-check" style="color:var(--verde); font-size:1.5rem; display:block; margin-bottom:.5rem"></i>
                Nenhuma candidatura pendente!
            </div>
            @endforelse
        </div>
    </div>

    {{-- Estudantes pendentes --}}
    <div class="card">
        <div class="card-header" style="display:flex; align-items:center; justify-content:space-between">
            <h3 style="color:var(--roxo-escuro)">
                <i class="fas fa-graduation-cap" style="color:var(--amarelo)"></i> Estudantes Pendentes
            </h3>
            <a href="{{ route('admin.estudantes.index', ['status'=>'pendente']) }}" class="btn btn-ghost btn-sm">Ver todos</a>
        </div>
        <div class="card-body" style="padding:0">
            @forelse($estudantesPendentes as $e)
            <div style="padding:1rem 1.5rem; border-bottom:1px solid var(--cinza-200); display:flex; align-items:center; justify-content:space-between">
                <div style="display:flex; align-items:center; gap:.75rem">
                    @if($e->foto)
                        <img src="{{ $e->foto_url }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0">
                    @else
                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-size:.85rem;font-weight:700;flex-shrink:0">
                            {{ strtoupper(substr($e->nome,0,1)) }}
                        </div>
                    @endif
                    <div>
                        <div style="font-weight:600; color:var(--cinza-800)">{{ $e->nome }}</div>
                        <div style="font-size:.78rem; color:var(--cinza-600)">{{ $e->instituicao }} · {{ $e->semestre }}</div>
                    </div>
                </div>
                <div style="display:flex; gap:.4rem">
                    <form action="{{ route('admin.estudantes.aprovar', $e->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="acao" value="aprovado">
                        <button type="submit" class="btn btn-primary btn-sm" title="Aprovar"><i class="fas fa-check"></i></button>
                    </form>
                    <form action="{{ route('admin.estudantes.aprovar', $e->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="acao" value="rejeitado">
                        <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar"><i class="fas fa-xmark"></i></button>
                    </form>
                </div>
            </div>
            @empty
            <div style="padding:2rem; text-align:center; color:var(--cinza-600); font-size:.92rem">
                <i class="fas fa-circle-check" style="color:var(--verde); font-size:1.5rem; display:block; margin-bottom:.5rem"></i>
                Nenhuma candidatura pendente!
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- Usuários recentes --}}
<div class="card">
    <div class="card-header" style="display:flex; align-items:center; justify-content:space-between">
        <h3 style="color:var(--roxo-escuro)"><i class="fas fa-user-plus" style="color:var(--verde)"></i> Usuários Recentes</h3>
        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost btn-sm">Ver todos</a>
    </div>
    <div class="card-body" style="padding:0">
        @foreach($usuariosRecentes as $u)
        <div style="padding:1rem 1.5rem; border-bottom:1px solid var(--cinza-200); display:flex; align-items:center; gap:.75rem">
            @if($u->avatar)
                <img src="{{ $u->avatar_url }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0">
            @else
                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.9rem;flex-shrink:0">
                    {{ strtoupper(substr($u->nome,0,1)) }}
                </div>
            @endif
            <div style="flex:1; min-width:0">
                <div style="font-weight:600; color:var(--cinza-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis">{{ $u->nome }}</div>
                <div style="font-size:.8rem; color:var(--cinza-600)">{{ $u->created_at->diffForHumans() }}</div>
            </div>
            <span class="badge {{ $u->ativo ? 'badge-green' : 'badge-red' }}">{{ $u->ativo ? 'Ativo' : 'Inativo' }}</span>
        </div>
        @endforeach
    </div>
</div>

@endsection