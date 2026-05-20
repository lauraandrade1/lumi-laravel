@extends('layouts.app')
@section('title', 'Cadastro de Psicólogo')

@section('content')
<div style="max-width:720px; margin:3rem auto; padding:0 1.5rem">
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro); font-size:1.6rem">
                <i class="fas fa-user-md" style="color:var(--roxo-principal)"></i>
                Torne-se um Profissional Parceiro
            </h2>
            <p style="color:var(--cinza-600); margin-top:.4rem; font-size:.92rem">Preencha o formulário. Sua candidatura será analisada em até 48 horas.</p>
        </div>
        <div class="card-body">

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <div>
                    <strong>Corrija os erros abaixo:</strong>
                    <ul style="margin-top:.3rem">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            </div>
            @endif

            <form action="{{ route('psicologos.store') }}" method="POST">
                @csrf

                <h4 style="color:var(--roxo-escuro); margin-bottom:1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Dados Pessoais</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome completo *</label>
                        <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome') }}" required placeholder="Seu nome completo">
                        @error('nome')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required placeholder="profissional@email.com">
                        @error('email')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="crp">Número do CRP *</label>
                        <input type="text" id="crp" name="crp" class="form-control @error('crp') is-invalid @enderror"
                            value="{{ old('crp') }}" required placeholder="Ex: SP/12345 ou 06/12345"
                            style="text-transform:uppercase">
                        <div id="crpFeedback" class="crp-feedback"></div>
                        <span class="help-text">Formato: UF/NNNNN — Região + número (ex: SP/12345)</span>
                        @error('crp')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone / WhatsApp</label>
                        <input type="text" id="telefone" name="telefone" class="form-control"
                            value="{{ old('telefone') }}" placeholder="(11) 91234-5678">
                    </div>
                </div>

                <h4 style="color:var(--roxo-escuro); margin:1.5rem 0 1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Informações Profissionais</h4>

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
                        <label for="modalidade">Modalidade de atendimento *</label>
                        <select id="modalidade" name="modalidade" class="form-select" required>
                            <option value="ambos"      {{ old('modalidade','ambos')=='ambos'?'selected':'' }}>Presencial e Online</option>
                            <option value="online"     {{ old('modalidade')=='online'?'selected':'' }}>Apenas Online</option>
                            <option value="presencial" {{ old('modalidade')=='presencial'?'selected':'' }}>Apenas Presencial</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control"
                            value="{{ old('cidade') }}" placeholder="São Paulo">
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
                            <input type="number" id="valor_consulta" name="valor_consulta" class="form-control"
                                value="{{ old('valor_consulta') }}" placeholder="150.00" step="0.01" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Biografia profissional * <span style="color:var(--cinza-600); font-weight:400">(mín. 50 caracteres)</span></label>
                    <textarea id="bio" name="bio" class="form-textarea @error('bio') is-invalid @enderror"
                        rows="5" required placeholder="Descreva sua formação, experiência, abordagem terapêutica e como você pode ajudar seus pacientes...">{{ old('bio') }}</textarea>
                    <div style="display:flex; justify-content:flex-end">
                        <span id="bioCounter" class="help-text">0 / 2000</span>
                    </div>
                    @error('bio')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                </div>

                <h4 style="color:var(--roxo-escuro); margin:1.5rem 0 1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Acesso ao Painel</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Senha *</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            required placeholder="Mínimo 8 caracteres">
                        @error('password')<span class="error-msg"><i class="fas fa-circle-xmark"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar senha *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required placeholder="Repita a senha">
                    </div>
                </div>

                <div style="background:var(--roxo-muitoclaro); border-radius:var(--raio); padding:1rem; margin-bottom:1.5rem; font-size:.88rem; color:var(--cinza-600)">
                    <i class="fas fa-circle-info" style="color:var(--roxo-principal)"></i>
                    Sua candidatura será analisada pela equipe Lumi em até 48 horas. Você receberá uma notificação por e-mail.
                </div>

                <div style="display:flex; gap:1rem; justify-content:flex-end">
                    <a href="{{ route('psicologos.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> Enviar Candidatura
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
