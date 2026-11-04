@extends('layouts.app')
@section('title', 'Editar Perfil')
@section('content')
<div style="max-width:640px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.5rem">
                <i class="fas fa-user-edit" style="color:var(--roxo-principal)"></i> Editar Perfil
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('usuario.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- AVATAR --}}
                <div class="form-group" style="margin-bottom:1.75rem">
                    <label>Foto de perfil</label>
                    <div style="display:flex;align-items:center;gap:1.5rem;padding:1.25rem;border:1.5px dashed var(--roxo-claro);border-radius:var(--raio);background:var(--roxo-muitoclaro)" id="avatarWrap">
                        <div style="position:relative;flex-shrink:0">
                            <div style="width:88px;height:88px;border-radius:50%;border:2px solid var(--roxo-claro);background:var(--cinza-200);display:flex;align-items:center;justify-content:center;overflow:hidden">
                                @if($usuario->avatar)
                                    <img id="avatarImg" src="{{ $usuario->avatar_url }}" style="width:100%;height:100%;object-fit:cover">
                                    <i class="fas fa-user" id="avatarIcon" style="display:none;font-size:2.2rem;color:var(--roxo-claro)"></i>
                                @else
                                    <i class="fas fa-user" id="avatarIcon" style="font-size:2.2rem;color:var(--roxo-claro)"></i>
                                    <img id="avatarImg" src="" style="display:none;width:100%;height:100%;object-fit:cover">
                                @endif
                            </div>
                            <button type="button" id="avatarRemoveBtn" onclick="removeFoto('avatar','avatarImg','avatarIcon','avatarRemoveBtn','avatarNome','avatarWrap')"
                                style="{{ $usuario->avatar ? 'display:flex' : 'display:none' }};position:absolute;top:-4px;right:-4px;width:22px;height:22px;border-radius:50%;background:var(--vermelho);border:none;color:#fff;font-size:.65rem;cursor:pointer;align-items:center;justify-content:center">
                                <i class="fas fa-xmark"></i>
                            </button>
                        </div>
                        <div>
                            <label for="avatar" style="display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;background:var(--roxo-principal);color:#fff;border-radius:var(--raio);font-size:.85rem;font-weight:600;cursor:pointer"
                                onmouseover="this.style.background='var(--roxo-escuro)'" onmouseout="this.style.background='var(--roxo-principal)'">
                                <i class="fas fa-camera"></i> {{ $usuario->avatar ? 'Trocar foto' : 'Escolher foto' }}
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png,image/webp" style="display:none"
                                onchange="previewFoto(this,'avatarImg','avatarIcon','avatarRemoveBtn','avatarNome','avatarWrap')">
                            <p style="margin:.5rem 0 0;font-size:.78rem;color:var(--cinza-600)">JPG, PNG ou WEBP · máx. 2 MB</p>
                            <p id="avatarNome" style="margin:.25rem 0 0;font-size:.78rem;color:var(--roxo-principal);font-weight:500;display:none"></p>
                        </div>
                    </div>
                    @error('avatar')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome completo *</label>
                        <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome',$usuario->nome) }}" required>
                        @error('nome')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email',$usuario->email) }}" required>
                        @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" class="form-control"
                            value="{{ old('telefone',$usuario->telefone) }}" placeholder="(11) 91234-5678">
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control"
                            value="{{ old('data_nascimento', $usuario->data_nascimento?->format('Y-m-d')) }}">
                    </div>
                </div>

                <hr style="border:none;border-top:1px solid var(--cinza-400);margin:1.5rem 0">
                <h4 style="color:var(--roxo-escuro);margin-bottom:1rem;font-size:1rem">Alterar senha <span style="color:var(--cinza-500);font-weight:400;font-size:.85rem">(deixe em branco para manter)</span></h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Nova senha</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mín. 8 caracteres">
                        @error('password')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar nova senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita a nova senha">
                    </div>
                </div>

                <div style="display:flex;gap:1rem;justify-content:flex-end;margin-top:.5rem">
                    <a href="{{ route('usuario.perfil') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewFoto(input,imgId,iconId,btnId,nomeId,wrapId){const file=input.files[0];if(!file)return;if(file.size>2*1024*1024){alert("Máx. 2 MB.");input.value="";return;}if(!["image/jpeg","image/png","image/webp"].includes(file.type)){alert("Use JPG, PNG ou WEBP.");input.value="";return;}const r=new FileReader();r.onload=e=>{document.getElementById(imgId).src=e.target.result;document.getElementById(imgId).style.display="block";document.getElementById(iconId).style.display="none";document.getElementById(btnId).style.display="flex";document.getElementById(nomeId).textContent=file.name;document.getElementById(nomeId).style.display="block";document.getElementById(wrapId).style.borderColor="var(--roxo-principal)";};r.readAsDataURL(file);}
function removeFoto(inputId,imgId,iconId,btnId,nomeId,wrapId){document.getElementById(inputId).value="";document.getElementById(imgId).src="";document.getElementById(imgId).style.display="none";document.getElementById(iconId).style.display="block";document.getElementById(btnId).style.display="none";document.getElementById(nomeId).style.display="none";document.getElementById(wrapId).style.borderColor="var(--roxo-claro)";}
</script>
@endsection
