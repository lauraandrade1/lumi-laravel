<?php $__env->startSection('title', 'Cadastro de Estudante de Psicologia'); ?>
<?php $__env->startSection('content'); ?>
<div style="max-width:720px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.6rem">
                <i class="fas fa-graduation-cap" style="color:var(--roxo-principal)"></i> Cadastro de Estudante de Psicologia
            </h2>
            <p style="color:var(--cinza-600);margin-top:.4rem;font-size:.92rem">Ofereça apoio emocional supervisionado. Candidatura analisada em até 48 horas.</p>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <div><strong>Corrija os erros:</strong>
                    <ul style="margin-top:.3rem"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('estudantes.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <h4 style="color:var(--roxo-escuro);margin-bottom:1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Dados Pessoais</h4>

                
                <div class="form-group" style="margin-bottom:1.75rem">
                    <label>Foto de perfil <span style="color:var(--cinza-500);font-weight:400">(opcional)</span></label>
                    <div style="display:flex;align-items:center;gap:1.5rem;padding:1.25rem;border:1.5px dashed var(--roxo-claro);border-radius:var(--raio);background:var(--roxo-muitoclaro)" id="fotoWrap">
                        <div style="position:relative;flex-shrink:0">
                            <div style="width:88px;height:88px;border-radius:50%;border:2px solid var(--roxo-claro);background:var(--cinza-200);display:flex;align-items:center;justify-content:center;overflow:hidden">
                                <i class="fas fa-user-graduate" id="fotoIcon" style="font-size:2rem;color:var(--roxo-claro)"></i>
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
                    <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nome')); ?>" required placeholder="Seu nome completo">
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
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required placeholder="seu@email.com">
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
                <div class="form-group">
                    <label for="telefone">Telefone / WhatsApp</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo e(old('telefone')); ?>" placeholder="(11) 91234-5678">
                </div>

                <h4 style="color:var(--roxo-escuro);margin:1.5rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Informações Acadêmicas</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="instituicao">Instituição de ensino *</label>
                        <input type="text" id="instituicao" name="instituicao" class="form-control <?php $__errorArgs = ['instituicao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('instituicao')); ?>" required placeholder="Ex: UNIFRAN, USP...">
                        <?php $__errorArgs = ['instituicao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="semestre">Semestre atual *</label>
                        <select id="semestre" name="semestre" class="form-select <?php $__errorArgs = ['semestre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Selecione...</option>
                            <?php $__currentLoopData = ['1º semestre','2º semestre','3º semestre','4º semestre','5º semestre','6º semestre','7º semestre','8º semestre','9º semestre','10º semestre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s); ?>" <?php echo e(old('semestre')==$s?'selected':''); ?>><?php echo e($s); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['semestre'];
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
                        <label for="area_estudo">Área de interesse *</label>
                        <select id="area_estudo" name="area_estudo" class="form-select <?php $__errorArgs = ['area_estudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Selecione...</option>
                            <?php $__currentLoopData = ['Ansiedade e Estresse','Autoestima e Autoconhecimento','Relacionamentos','Saúde Mental Geral','Orientação Vocacional','Outro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($a); ?>" <?php echo e(old('area_estudo')==$a?'selected':''); ?>><?php echo e($a); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['area_estudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="modalidade">Modalidade *</label>
                        <select id="modalidade" name="modalidade" class="form-select" required>
                            <option value="ambos" <?php echo e(old('modalidade','ambos')=='ambos'?'selected':''); ?>>Online e Presencial</option>
                            <option value="online" <?php echo e(old('modalidade')=='online'?'selected':''); ?>>Apenas Online</option>
                            <option value="presencial" <?php echo e(old('modalidade')=='presencial'?'selected':''); ?>>Apenas Presencial</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo e(old('cidade')); ?>" placeholder="São Paulo">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="">UF</option>
                            <?php $__currentLoopData = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($uf); ?>" <?php echo e(old('estado')==$uf?'selected':''); ?>><?php echo e($uf); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio">Apresentação * <span style="color:var(--cinza-600);font-weight:400">(mín. 50 caracteres)</span></label>
                    <textarea id="bio" name="bio" class="form-textarea <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5" required placeholder="Conte sobre sua trajetória acadêmica, motivação e como você pode ajudar..."><?php echo e(old('bio')); ?></textarea>
                    <div style="display:flex;justify-content:flex-end"><span id="bioCounter" class="help-text">0 / 2000</span></div>
                    <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <h4 style="color:var(--roxo-escuro);margin:1.5rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--cinza-400)">Acesso ao Painel</h4>
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
unset($__errorArgs, $__bag); ?>" required placeholder="Mínimo 8 caracteres">
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
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Repita a senha">
                    </div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem;margin-bottom:1.5rem;font-size:.88rem;color:var(--cinza-600)">
                    <i class="fas fa-circle-info" style="color:var(--roxo-principal)"></i>
                    Atendimentos devem ser realizados sob supervisão de um psicólogo formado. Sua candidatura será analisada em até 48 horas.
                </div>
                <div style="display:flex;gap:1rem;justify-content:flex-end">
                    <a href="<?php echo e(route('psicologos.index')); ?>" class="btn btn-ghost">Cancelar</a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/estudantes/create.blade.php ENDPATH**/ ?>