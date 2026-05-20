<?php $__env->startSection('title', 'Cadastro de Psicólogo'); ?>

<?php $__env->startSection('content'); ?>
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

            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <div>
                    <strong>Corrija os erros abaixo:</strong>
                    <ul style="margin-top:.3rem"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('psicologos.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <h4 style="color:var(--roxo-escuro); margin-bottom:1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Dados Pessoais</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome completo *</label>
                        <input type="text" id="nome" name="nome" class="form-control <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('nome')); ?>" required placeholder="Seu nome completo">
                        <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('email')); ?>" required placeholder="profissional@email.com">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="crp">Número do CRP *</label>
                        <input type="text" id="crp" name="crp" class="form-control <?php $__errorArgs = ['crp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('crp')); ?>" required placeholder="Ex: SP/12345 ou 06/12345"
                            style="text-transform:uppercase">
                        <div id="crpFeedback" class="crp-feedback"></div>
                        <span class="help-text">Formato: UF/NNNNN — Região + número (ex: SP/12345)</span>
                        <?php $__errorArgs = ['crp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone / WhatsApp</label>
                        <input type="text" id="telefone" name="telefone" class="form-control"
                            value="<?php echo e(old('telefone')); ?>" placeholder="(11) 91234-5678">
                    </div>
                </div>

                <h4 style="color:var(--roxo-escuro); margin:1.5rem 0 1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Informações Profissionais</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="especialidade">Especialidade principal *</label>
                        <select id="especialidade" name="especialidade" class="form-select <?php $__errorArgs = ['especialidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Selecione...</option>
                            <?php $__currentLoopData = ['Ansiedade','Depressão','Relacionamentos','Autoestima','Orientação Profissional','Trauma e PTSD','Terapia Infantil','Terapia de Casal','Outro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($esp); ?>" <?php echo e(old('especialidade')==$esp?'selected':''); ?>><?php echo e($esp); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['especialidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="modalidade">Modalidade de atendimento *</label>
                        <select id="modalidade" name="modalidade" class="form-select" required>
                            <option value="ambos"      <?php echo e(old('modalidade','ambos')=='ambos'?'selected':''); ?>>Presencial e Online</option>
                            <option value="online"     <?php echo e(old('modalidade')=='online'?'selected':''); ?>>Apenas Online</option>
                            <option value="presencial" <?php echo e(old('modalidade')=='presencial'?'selected':''); ?>>Apenas Presencial</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control"
                            value="<?php echo e(old('cidade')); ?>" placeholder="São Paulo">
                    </div>
                    <div class="form-row" style="grid-template-columns:1fr 1fr">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-select">
                                <option value="">UF</option>
                                <?php $__currentLoopData = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($uf); ?>" <?php echo e(old('estado')==$uf?'selected':''); ?>><?php echo e($uf); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="valor_consulta">Valor/sessão (R$)</label>
                            <input type="number" id="valor_consulta" name="valor_consulta" class="form-control"
                                value="<?php echo e(old('valor_consulta')); ?>" placeholder="150.00" step="0.01" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bio">Biografia profissional * <span style="color:var(--cinza-600); font-weight:400">(mín. 50 caracteres)</span></label>
                    <textarea id="bio" name="bio" class="form-textarea <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        rows="5" required placeholder="Descreva sua formação, experiência, abordagem terapêutica e como você pode ajudar seus pacientes..."><?php echo e(old('bio')); ?></textarea>
                    <div style="display:flex; justify-content:flex-end">
                        <span id="bioCounter" class="help-text">0 / 2000</span>
                    </div>
                    <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <h4 style="color:var(--roxo-escuro); margin:1.5rem 0 1rem; padding-bottom:.5rem; border-bottom:1px solid var(--cinza-400)">Acesso ao Painel</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Senha *</label>
                        <input type="password" id="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required placeholder="Mínimo 8 caracteres">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <a href="<?php echo e(route('psicologos.index')); ?>" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> Enviar Candidatura
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/psicologos/create.blade.php ENDPATH**/ ?>