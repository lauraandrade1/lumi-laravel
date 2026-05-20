<?php $__env->startSection('title', 'Diário Emocional'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:900px; margin:3rem auto; padding:0 1.5rem">

    <div style="text-align:center; margin-bottom:3rem">
        <h1 class="section-title">Seu Diário Emocional</h1>
        <p class="section-subtitle" style="margin-bottom:0">
            Um espaço privado para registrar seus pensamentos e sentimentos. Seus dados são seus.
        </p>
    </div>

    
    <div class="card" style="margin-bottom:2.5rem">
        <div class="card-header">
            <h3 style="color:var(--roxo-escuro); display:flex; align-items:center; gap:.5rem">
                <i class="fas fa-pen-to-square" style="color:var(--roxo-principal)"></i>
                Nova Entrada
            </h3>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('diario.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="form-group">
                    <label>Como você está se sentindo hoje? *</label>
                    <div class="humor-chips">
                        <?php $__currentLoopData = [1=>'😢 Muito Triste',2=>'😕 Triste',3=>'😐 Neutro',4=>'😊 Feliz',5=>'😄 Muito Feliz']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="humor-chip <?php echo e(old('nivel_humor')==$val?'selected':''); ?>" data-val="<?php echo e($val); ?>">
                            <?php echo e($label); ?>

                        </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" id="nivel_humor" name="nivel_humor" value="<?php echo e(old('nivel_humor')); ?>">
                    <?php $__errorArgs = ['nivel_humor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg" style="margin-top:.4rem"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label>Emoções que você está sentindo (opcional)</label>
                    <div style="display:flex; gap:.5rem; flex-wrap:wrap">
                        <?php $__currentLoopData = ['Ansioso','Esperançoso','Cansado','Grato','Frustrado','Calmo','Animado','Sobrecarregado','Saudoso','Motivado']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="emocao-tag-btn humor-chip" data-tag="<?php echo e($tag); ?>"
                            style="font-size:.82rem; padding:.3rem .8rem">
                            <?php echo e($tag); ?>

                        </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" id="emocoes_tags_input" name="emocoes_tags" value="[]">
                </div>

                
                <div class="form-group">
                    <label for="conteudo">O que está na sua mente? *</label>
                    <textarea id="conteudo" name="conteudo" class="form-textarea <?php $__errorArgs = ['conteudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        rows="6" required
                        placeholder="Escreva sobre seu dia, sentimentos, pensamentos... Este é um espaço seguro para expressar o que está em sua mente."><?php echo e(old('conteudo')); ?></textarea>
                    <?php $__errorArgs = ['conteudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <button type="reset" class="btn btn-ghost">
                        <i class="fas fa-eraser"></i> Limpar
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-floppy-disk"></i> Salvar Entrada
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <h3 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro); margin-bottom:1.25rem">
        <i class="fas fa-clock-rotate-left" style="color:var(--roxo-principal)"></i>
        Entradas Anteriores
    </h3>

    <?php if($entradas->isEmpty()): ?>
    <div style="text-align:center; padding:3rem; color:var(--cinza-600); background:var(--branco); border-radius:var(--raio-lg); border:1px solid var(--roxo-palido)">
        <div style="font-size:3.5rem; margin-bottom:.75rem; opacity:.3">📖</div>
        <p>Você ainda não tem entradas no diário. Comece escrevendo acima!</p>
    </div>
    <?php else: ?>
    <?php $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="journal-entry-card" style="border-left-color: <?php echo e($entrada->humor_color); ?>">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:.75rem">
            <div>
                <span style="font-size:1.2rem"><?php echo e($entrada->humor_label); ?></span>
                <?php if($entrada->emocoes_tags): ?>
                <div style="display:flex; gap:.4rem; flex-wrap:wrap; margin-top:.4rem">
                    <?php $__currentLoopData = $entrada->emocoes_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge badge-purple" style="font-size:.72rem"><?php echo e($tag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
            <div style="display:flex; align-items:center; gap:.75rem">
                <span style="font-size:.82rem; color:var(--cinza-600)">
                    <i class="fas fa-calendar"></i>
                    <?php echo e($entrada->created_at->format('d/m/Y')); ?>

                    <?php echo e($entrada->created_at->format('H:i')); ?>

                </span>
                <div style="display:flex; gap:.4rem">
                    <a href="<?php echo e(route('diario.edit', $entrada->id)); ?>" class="btn btn-ghost btn-sm" title="Editar">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="<?php echo e(route('diario.destroy', $entrada->id)); ?>" method="POST" style="display:inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                            data-confirm="Excluir esta entrada do diário?">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <p style="color:var(--cinza-800); line-height:1.7; white-space:pre-line"><?php echo e(Str::limit($entrada->conteudo, 300)); ?></p>
        <?php if(strlen($entrada->conteudo) > 300): ?>
        <a href="<?php echo e(route('diario.edit', $entrada->id)); ?>" style="font-size:.85rem; color:var(--roxo-principal)">Ler completo →</a>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div><?php echo e($entradas->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/diario/index.blade.php ENDPATH**/ ?>