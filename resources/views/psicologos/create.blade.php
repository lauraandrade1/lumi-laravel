@extends('layouts.app')
@section('title', 'Cadastro de Psicólogo')
@section('content')
<div style="max-width:720px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.6rem">
                <i class="fas fa-user-md" style="color:var(--roxo-principal)"></i> Torne-se um Profissional Parceiro
            </h2>
            <p style="color:var(--cinza-600);margin-top:.4rem;font-size:.92rem">Preencha o formulário. Sua candidatura será analisada em até 48 horas.</p>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <div><strong>Corrija os erros abaixo:</strong>
                    <ul style="margin-top:.3rem">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            </div>
            @endif

            <form action="{{ route('psicologos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 style="color:var(--roxo-escuro);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Dados Pessoais</h4>

                {{-- FOTO --}}
                <div class="form-group" style="margin-bottom:1.75rem">
                    <label>Foto de perfil <span style="color:var(--cinza-500);font-weight:400">(opcional)</span></label>
                    <div style="display:flex;align-items:center;gap:1.5rem;padding:1.25rem;border:1.5px dashed var(--roxo-claro);border-radius:var(--raio);background:var(--roxo-muitoclaro)" id="fotoWrap">
                        <div style="position:relative;flex-shrink:0">
                            <div style="width:88px;height:88px;border-radius:50%;border:2px solid var(--roxo-claro);background:var(--cinza-200);display:flex;align-items:center;justify-content:center;overflow:hidden">
                                <i class="fas fa-user" id="fotoIcon" style="font-size:2.2rem;color:var(--roxo-claro)"></i>
                                <img id="fotoImg" src="" style="display:none;width:100%;height:100%;object-fit:cover">
                            </div>
                            <button type="button" id="fotoRemoveBtn" onclick="removeFoto('foto','fotoImg','fotoIcon','fotoRemoveBtn','fotoNome','fotoWrap')"
                                style="display:none;position:absolute;top:-4px;right:-4px;width:22px;height:22px;border-radius:50%;background:var(--vermelho);border:none;color:#fff;font-size:.65rem;cursor:pointer;align-items:center;justify-content:center">
                                <i class="fas fa-xmark"></i>
                            </button>
                        </div>
                        <div>
                            <label for="foto" style="display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;background:var(--roxo-principal);color:#fff;border-radius:var(--raio);font-size:.85rem;font-weight:600;cursor:pointer"
                                onmouseover="this.style.background='var(--roxo-escuro)'" onmouseout="this.style.background='var(--roxo-principal)'">
                                <i class="fas fa-camera"></i> Escolher foto
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp" style="display:none"
                                onchange="previewFoto(this,'fotoImg','fotoIcon','fotoRemoveBtn','fotoNome','fotoWrap')">
                            <p style="margin:.5rem 0 0;font-size:.78rem;color:var(--cinza-600)">JPG, PNG ou WEBP · máx. 2 MB</p>
                            <p id="fotoNome" style="margin:.25rem 0 0;font-size:.78rem;color:var(--roxo-principal);font-weight:500;display:none"></p>
                        </div>
                    </div>
                    @error('foto')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome completo *</label>
                        <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required placeholder="Seu nome completo">
                        @error('nome')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="profissional@email.com">
                        @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="crp">Número do CRP *</label>
                        <input type="text" id="crp" name="crp" class="form-control @error('crp') is-invalid @enderror" value="{{ old('crp') }}" required placeholder="Ex: SP/12345" style="text-transform:uppercase">
                        <div id="crpFeedback" class="crp-feedback"></div>
                        <span class="help-text">Formato: UF/NNNNN (ex: SP/12345)</span>
                        @error('crp')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone / WhatsApp</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" value="{{ old('telefone') }}" placeholder="(11) 91234-5678">
                    </div>
                </div>

                <h4 style="color:var(--roxo-escuro);margin:1.5rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Informações Profissionais</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="especialidade">Especialidade principal *</label>
                        <select id="especialidade" name="especialidade" class="form-select @error('especialidade') is-invalid @enderror" required>
                            <option value="">Selecione...</option>
                            @foreach(['Ansiedade','Depressão','Relacionamentos','Autoestima','Orientação Profissional','Trauma e PTSD','Terapia Infantil','Terapia de Casal','Outro'] as $esp)
                            <option value="{{ $esp }}" {{ old('especialidade')==$esp?'selected':'' }}>{{ $esp }}</option>
                            @endforeach
                        </select>
                        @error('especialidade')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="modalidade">Modalidade *</label>
                        <select id="modalidade" name="modalidade" class="form-select" required>
                            <option value="ambos" {{ old('modalidade','ambos')=='ambos'?'selected':'' }}>Presencial e Online</option>
                            <option value="online" {{ old('modalidade')=='online'?'selected':'' }}>Apenas Online</option>
                            <option value="presencial" {{ old('modalidade')=='presencial'?'selected':'' }}>Apenas Presencial</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" value="{{ old('cidade') }}" placeholder="São Paulo">
                    </div>
                    <div class="form-row" style="grid-template-columns:1fr 1fr">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-select">
                                <option value="">UF</option>
                                @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf)
                                <option value="{{ $uf }}" {{ old('estado')==$uf?'selected':'' }}>{{ $uf }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="valor_consulta">Valor/sessão (R$)</label>
                            <input type="number" id="valor_consulta" name="valor_consulta" class="form-control" value="{{ old('valor_consulta') }}" placeholder="150.00" step="0.01" min="0">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio">Biografia profissional * <span style="color:var(--cinza-600);font-weight:400">(mín. 50 caracteres)</span></label>
                    <textarea id="bio" name="bio" class="form-textarea @error('bio') is-invalid @enderror" rows="5" required placeholder="Descreva sua formação, experiência e abordagem terapêutica...">{{ old('bio') }}</textarea>
                    <div style="display:flex;justify-content:flex-end"><span id="bioCounter" class="help-text">0 / 2000</span></div>
                    @error('bio')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                <h4 style="color:var(--roxo-escuro);margin:1.5rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Acesso ao Painel</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Senha *</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Mínimo 8 caracteres">
                        @error('password')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar senha *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Repita a senha">
                    </div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem;margin-bottom:1.5rem;font-size:.88rem;color:var(--cinza-600)">
                    <i class="fas fa-circle-info" style="color:var(--roxo-principal)"></i>
                    Sua candidatura será analisada pela equipe Lumi em até 48 horas.
                </div>
                <div style="display:flex;gap:1rem;justify-content:flex-end">
                    <a href="{{ route('psicologos.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Enviar Candidatura</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewFoto(input,imgId,iconId,btnId,nomeId,wrapId){const file=input.files[0];if(!file)return;if(file.size>2*1024*1024){alert("Máx. 2 MB.");input.value="";return;}if(!["image/jpeg","image/png","image/webp"].includes(file.type)){alert("Use JPG, PNG ou WEBP.");input.value="";return;}const r=new FileReader();r.onload=e=>{document.getElementById(imgId).src=e.target.result;document.getElementById(imgId).style.display="block";document.getElementById(iconId).style.display="none";document.getElementById(btnId).style.display="flex";document.getElementById(nomeId).textContent=file.name;document.getElementById(nomeId).style.display="block";document.getElementById(wrapId).style.borderColor="var(--roxo-principal)";};r.readAsDataURL(file);}
function removeFoto(inputId,imgId,iconId,btnId,nomeId,wrapId){document.getElementById(inputId).value="";document.getElementById(imgId).src="";document.getElementById(imgId).style.display="none";document.getElementById(iconId).style.display="block";document.getElementById(btnId).style.display="none";document.getElementById(nomeId).style.display="none";document.getElementById(wrapId).style.borderColor="var(--roxo-claro)";}
const bio=document.getElementById('bio'),counter=document.getElementById('bioCounter');
if(bio&&counter){const u=()=>counter.textContent=bio.value.length+' / 2000';bio.addEventListener('input',u);u();}
</script>
@endsection
