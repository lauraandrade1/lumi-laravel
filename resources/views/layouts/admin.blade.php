<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Painel') | Lumi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/lumi.css') }}">
</head>
<body style="background:var(--cinza-100)">

<div style="display:flex; min-height:100vh">

    {{-- SIDEBAR ─────────────────────────────────────────────── --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">
            🧠 Lumi
            <div style="font-size:.75rem; color:rgba(255,255,255,.5); font-family:var(--fonte-corpo); font-weight:400; margin-top:.2rem">Painel Administrativo</div>
        </div>

        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i> Dashboard
            </a>

            <div style="padding:.5rem 1.5rem; font-size:.72rem; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.35); margin-top:.5rem">Usuários</div>
            <a href="{{ route('admin.usuarios.index') }}" class="{{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Usuários
            </a>
            <a href="{{ route('admin.psicologos.index') }}" class="{{ request()->routeIs('admin.psicologos.*') ? 'active' : '' }}">
                <i class="fas fa-user-md"></i> Psicólogos
                @php $pendentes = \App\Models\Psicologo::where('status','pendente')->count() @endphp
                @if($pendentes > 0)
                <span style="margin-left:auto; background:#ef4444; color:#fff; border-radius:50px; padding:.1rem .5rem; font-size:.72rem">{{ $pendentes }}</span>
                @endif
            </a>

            <div style="padding:.5rem 1.5rem; font-size:.72rem; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.35); margin-top:.5rem">Conteúdo</div>
            <a href="{{ route('admin.exercicios.index') }}" class="{{ request()->routeIs('admin.exercicios.*') ? 'active' : '' }}">
                <i class="fas fa-spa"></i> Exercícios
            </a>
            <a href="{{ route('admin.materiais.index') }}" class="{{ request()->routeIs('admin.materiais.*') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> Materiais
            </a>

            <div style="padding:.5rem 1.5rem; font-size:.72rem; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.35); margin-top:.5rem">Sistema</div>
            <a href="{{ route('home') }}">
                <i class="fas fa-globe"></i> Ver Site
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" style="display:flex; align-items:center; gap:.75rem; padding:.7rem 1.5rem; width:100%; border:none; background:none; text-align:left; font-size:.92rem; color:rgba(255,255,255,.75); cursor:pointer; font-family:var(--fonte-corpo); transition:all .25s ease">
                    <i class="fas fa-right-from-bracket" style="width:18px"></i> Sair
                </button>
            </form>
        </nav>
    </aside>

    {{-- MAIN ────────────────────────────────────────────────── --}}
    <main style="flex:1; margin-left:260px; padding:2rem; min-height:100vh">

        {{-- Flash --}}
        @if(session('success'))
        <div class="flash flash-success" id="flashMsg">
            <i class="fas fa-circle-check"></i>
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()"><i class="fas fa-xmark"></i></button>
        </div>
        @endif
        @if(session('error'))
        <div class="flash flash-error" id="flashMsg">
            <i class="fas fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()"><i class="fas fa-xmark"></i></button>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="{{ asset('js/lumi.js') }}"></script>
@stack('scripts')
</body>
</html>
