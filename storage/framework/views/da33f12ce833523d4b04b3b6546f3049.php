<?php $__env->startSection('title', 'Exercícios Guiados'); ?>

<?php $__env->startSection('content'); ?>
<div style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); padding:4rem 1.5rem; text-align:center">
    <h1 style="font-family:var(--fonte-titulo); color:var(--branco); font-size:2.5rem; margin-bottom:.75rem">
        Exercícios Guiados
    </h1>
    <p style="color:rgba(255,255,255,.8); max-width:550px; margin:0 auto; font-size:1.05rem">
        Técnicas de respiração, meditação e relaxamento desenvolvidas para ajudar no gerenciamento do estresse e ansiedade.
    </p>
</div>

<div class="exercicios-section">

    <?php if($exercicios->isEmpty()): ?>
    <div style="text-align:center; padding:4rem; color:var(--cinza-600)">
        <div style="font-size:4rem; margin-bottom:1rem; opacity:.3">🧘</div>
        <p>Nenhum exercício disponível no momento. Volte em breve!</p>
    </div>
    <?php else: ?>
    <?php $__currentLoopData = $exercicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria => $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="margin-bottom:3rem">
        <?php
            $icones = ['respiracao'=>'fas fa-wind','meditacao'=>'fas fa-om','relaxamento'=>'fas fa-spa','mindfulness'=>'fas fa-brain','outro'=>'fas fa-star'];
            $labels = ['respiracao'=>'Respiração','meditacao'=>'Meditação','relaxamento'=>'Relaxamento','mindfulness'=>'Mindfulness','outro'=>'Outros'];
        ?>
        <div class="categoria-label">
            <i class="<?php echo e($icones[$categoria] ?? 'fas fa-star'); ?>" style="color:var(--roxo-principal)"></i>
            <?php echo e($labels[$categoria] ?? ucfirst($categoria)); ?>

        </div>

        <div style="display:grid; gap:1.25rem; grid-template-columns:repeat(auto-fill,minmax(320px,1fr))">
            <?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="exercicio-card">
                <div style="display:flex; align-items:flex-start; gap:1rem">
                    <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:1.2rem; flex-shrink:0">
                        <i class="<?php echo e($ex->icone); ?>"></i>
                    </div>
                    <div style="flex:1">
                        <h4 style="color:var(--roxo-escuro); margin-bottom:.3rem"><?php echo e($ex->titulo); ?></h4>
                        <p style="font-size:.88rem; color:var(--cinza-600); margin-bottom:.75rem"><?php echo e($ex->descricao); ?></p>
                        <span class="badge badge-purple">
                            <i class="fas fa-clock"></i> <?php echo e($ex->duracao_minutos); ?> min
                        </span>

                        <?php if($ex->passos && count($ex->passos)): ?>
                        <details style="margin-top:.75rem">
                            <summary style="cursor:pointer; font-size:.88rem; font-weight:600; color:var(--roxo-principal)">
                                Ver passo a passo
                            </summary>
                            <ol style="margin-top:.5rem; padding-left:1.25rem; font-size:.88rem; color:var(--cinza-600); line-height:2">
                                <?php $__currentLoopData = $ex->passos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $passo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($passo); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </details>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/exercicios/index.blade.php ENDPATH**/ ?>