@extends('layouts.admin')
@section('title', 'Editar Psicólogo')

@section('content')
<div style="max-width:720px">
    <a href="{{ route('admin.psicologos.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar: {{ $psicologo->nome }}
            </h2>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.psicologos.update', $psicologo->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome *</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $psicologo->nome) }}" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $psicologo->email) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>CRP *</label>
                        <input type="text" id="crp" name="crp" class="form-control" value="{{ old('crp', $psicologo->crp) }}" required style="text-transform:uppercase">
                        <div id="crpFeedback" class="crp-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $psicologo->telefone) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Especialidade *</label>
                        <input type="text" name="especialidade" class="form-control" value="{{ old('especialidade', $psicologo->especialidade) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Modalidade *</label>
                        <select name="modalidade" class="form-select" required>
                            <option value="ambos"      {{ $psicologo->modalidade=='ambos'?'selected':'' }}>Presencial e Online</option>
                            <option value="online"     {{ $psicologo->modalidade=='online'?'selected':'' }}>Apenas Online</option>
                            <option value="presencial" {{ $psicologo->modalidade=='presencial'?'selected':'' }}>Apenas Presencial</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $psicologo->cidade) }}">
                    </div>
                    <div class="form-row" style="grid-template-columns:1fr 1fr">
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-select">
                                <option value="">UF</option>
                                @foreach(['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf)
                                <option value="{{ $uf }}" {{ $psicologo->estado==$uf?'selected':'' }}>{{ $uf }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor/sessão</label>
                            <input type="number" name="valor_consulta" class="form-control" value="{{ old('valor_consulta', $psicologo->valor_consulta) }}" step="0.01" min="0">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Biografia *</label>
                    <textarea id="bio" name="bio" class="form-textarea" rows="5" required>{{ old('bio', $psicologo->bio) }}</textarea>
                    <div style="display:flex; justify-content:flex-end"><span id="bioCounter" class="help-text"></span></div>
                </div>
                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="pendente"  {{ $psicologo->status=='pendente' ?'selected':'' }}>Pendente</option>
                        <option value="aprovado"  {{ $psicologo->status=='aprovado' ?'selected':'' }}>Aprovado</option>
                        <option value="rejeitado" {{ $psicologo->status=='rejeitado'?'selected':'' }}>Rejeitado</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nova Senha <span style="font-weight:400; color:var(--cinza-600)">(opcional)</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Deixe em branco para manter">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <a href="{{ route('admin.psicologos.index') }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
