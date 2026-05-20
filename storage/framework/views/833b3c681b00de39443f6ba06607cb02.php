<?php $__env->startSection('title', $material->titulo); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:800px; margin:3rem auto; padding:0 1.5rem">
    <a href="<?php echo e(route('materiais.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar aos Materiais
    </a>
    <div class="card">
        <div style="height:200px; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; font-size:5rem; color:var(--branco); opacity:.8">
            <i class="fas <?php echo e($material->tipo_icone); ?>"></i>
        </div>
        <div class="card-body" style="padding:2rem">
            <span class="badge badge-purple" style="margin-bottom:1rem"><?php echo e($material->tipo_label); ?></span>
            <h1 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro); font-size:1.8rem; margin-bottom:1rem"><?php echo e($material->titulo); ?></h1>
            <p style="color:var(--cinza-600); line-height:1.8; font-size:1rem; margin-bottom:2rem"><?php echo e($material->descricao); ?></p>

            <?php if($material->url): ?>
            <a href="<?php echo e($material->url); ?>" target="_blank" class="btn btn-primary btn-lg">
                <i class="fas fa-external-link-alt"></i> Acessar Material
            </a>
            <?php endif; ?>
            <?php if($material->arquivo): ?>
            <a href="<?php echo e(asset('storage/'.$material->arquivo)); ?>" class="btn btn-secondary btn-lg" download>
                <i class="fas fa-download"></i> Fazer Download
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/materiais/show.blade.php ENDPATH**/ ?>