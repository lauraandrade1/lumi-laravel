@extends('layouts.app')
@section('title', 'Cadastro')
@section('content')
<div class="auth-page" style="padding:3rem 1rem">
    <div class="auth-card" style="max-width:560px">
        <div class="auth-logo"></div>
        <h1>Crie sua conta</h1>
        <p class="auth-subtitle">Junte-se à Lumi — é gratuito!</p>

        @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-triangle-exclamation"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- FOTO DE PERFIL --}}
            <div class="form-group" style="margin-bottom:1.5rem">
                <label>Foto de perfil <span style="color:var(--cinza-500);font-weight:400">(opcional)</span></label>
                <div style="display:flex;align-items:center;gap:1.25rem;padding:1rem;border:1.5px dashed var(--roxo-claro);border-radius:var(--raio);background:var(--roxo-muitoclaro)" id="avatarWrap">
                    <div style="position:relative;flex-shrink:0">
                        <div style="width:72px;height:72px;border-radius:50%;border:2px solid var(--roxo-claro);background:var(--cinza-200);display:flex;align-items:center;justify-content:center;overflow:hidden">
                            <i class="fas fa-user" id="avatarIcon" style="font-size:1.8rem;color:var(--roxo-claro)"></i>
                            <img id="avatarImg" src="" style="display:none;width:100%;height:100%;object-fit:cover">
                        </div>
                        <button type="button" id="avatarRemoveBtn" onclick="removeFoto('avatar','avatarImg','avatarIcon','avatarRemoveBtn','avatarNome','avatarWrap')"
                            style="display:none;position:absolute;top:-4px;right:-4px;width:20px;height:20px;border-radius:50%;background:var(--vermelho);border:none;color:#fff;font-size:.6rem;cursor:pointer;align-items:center;justify-content:center">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                    <div>
                        <label for="avatar" style="display:inline-flex;align-items:center;gap:.4rem;padding:.45rem 1rem;background:var(--roxo-principal);color:#fff;border-radius:var(--raio);font-size:.82rem;font-weight:600;cursor:pointer"
                            onmouseover="this.style.background='var(--roxo-escuro)'" onmouseout="this.style.background='var(--roxo-principal)'">
                            <i class="fas fa-camera"></i> Escolher foto
                        </label>
                        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp" style="display:none"
                            onchange="previewFoto(this,'avatarImg','avatarIcon','avatarRemoveBtn','avatarNome','avatarWrap')">
                        <p style="margin:.4rem 0 0;font-size:.75rem;color:var(--cinza-600)">JPG, PNG ou WEBP · máx. 2 MB</p>
                        <p id="avatarNome" style="margin:.2rem 0 0;font-size:.75rem;color:var(--roxo-principal);font-weight:500;display:none"></p>
                    </div>
                </div>
                @error('avatar')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome completo *</label>
                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome') }}" placeholder="Seu nome" required autofocus>
                    @error('nome')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="seu@email.com" required>
                    @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone') }}" placeholder="(11) 91234-5678">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Senha *</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mín. 8 caracteres" required>
                    @error('password')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmar senha *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita a senha" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top:.5rem">
                <i class="fas fa-user-plus"></i> Criar conta
            </button>
        </form>
        <p style="text-align:center;margin-top:1.5rem;font-size:.92rem;color:var(--cinza-600)">
            Já tem uma conta? <a href="{{ route('login') }}" style="font-weight:600">Faça login</a>
        </p>
        <p style="text-align:center;margin-top:.75rem">
            <a href="{{ route('home') }}" style="font-size:.88rem;color:var(--cinza-600)"><i class="fas fa-arrow-left"></i> Voltar para o início</a>
        </p>
    </div>
</div>
<script>
function previewFoto(input,imgId,iconId,btnId,nomeId,wrapId){const file=input.files[0];if(!file)return;if(file.size>2*1024*1024){alert("Máx. 2 MB.");input.value="";return;}if(!["image/jpeg","image/png","image/webp"].includes(file.type)){alert("Use JPG, PNG ou WEBP.");input.value="";return;}const r=new FileReader();r.onload=e=>{document.getElementById(imgId).src=e.target.result;document.getElementById(imgId).style.display="block";document.getElementById(iconId).style.display="none";document.getElementById(btnId).style.display="flex";document.getElementById(nomeId).textContent=file.name;document.getElementById(nomeId).style.display="block";document.getElementById(wrapId).style.borderColor="var(--roxo-principal)";};r.readAsDataURL(file);}
function removeFoto(inputId,imgId,iconId,btnId,nomeId,wrapId){document.getElementById(inputId).value="";document.getElementById(imgId).src="";document.getElementById(imgId).style.display="none";document.getElementById(iconId).style.display="block";document.getElementById(btnId).style.display="none";document.getElementById(nomeId).style.display="none";document.getElementById(wrapId).style.borderColor="var(--roxo-claro)";}
</script>
@endsection
