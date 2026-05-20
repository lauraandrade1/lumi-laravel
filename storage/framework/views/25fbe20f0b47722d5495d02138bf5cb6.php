<?php $__env->startSection('title', 'Materiais Educativos'); ?>

<?php $__env->startSection('content'); ?>
<div style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); padding:4rem 1.5rem; text-align:center">
    <h1 style="font-family:var(--fonte-titulo); color:var(--branco); font-size:2.5rem; margin-bottom:.75rem">Materiais Educativos</h1>
    <p style="color:rgba(255,255,255,.8); max-width:550px; margin:0 auto; font-size:1.05rem">
        Artigos, vídeos e workbooks desenvolvidos por especialistas para enriquecer sua jornada.
    </p>
</div>

<div class="section">
    
    <form method="GET" style="display:flex; gap:.75rem; margin-bottom:2rem; flex-wrap:wrap">
        <?php $__currentLoopData = ['' => 'Todos', 'artigo'=>'Artigos','video'=>'Vídeos','workbook'=>'Workbooks','podcast'=>'Podcasts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('materiais.index', $val ? ['tipo'=>$val] : [])); ?>"
           class="btn <?php echo e(request('tipo')==$val && ($val || !request('tipo')) ? 'btn-primary' : 'btn-secondary'); ?> btn-sm">
            <?php echo e($label); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </form>

    <?php if($materiais->isEmpty()): ?>
    <div style="text-align:center; padding:4rem; color:var(--cinza-600)">
        <div style="font-size:4rem; margin-bottom:1rem; opacity:.3">📚</div>
        <p>Nenhum material disponível nesta categoria.</p>
    </div>
    <?php else: ?>
    <div style="display:grid; gap:1.5rem; grid-template-columns:repeat(auto-fill,minmax(280px,1fr))">
        <?php $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('materiais.show', $m->id)); ?>" class="card" style="text-decoration:none; display:block">
            <div style="height:120px; background:linear-gradient(135deg,var(--roxo-muitoclaro),var(--roxo-palido)); display:flex; align-items:center; justify-content:center; font-size:3rem">
                <i class="fas <?php echo e($m->tipo_icone); ?>" style="color:var(--roxo-principal)"></i>
            </div>
            <div class="card-body">
                <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem">
                    <span class="badge badge-purple"><?php echo e($m->tipo_label); ?></span>
                    <span style="font-size:.8rem; color:var(--cinza-600)"><i class="fas fa-eye"></i> <?php echo e($m->visualizacoes); ?></span>
                </div>
                <h3 style="color:var(--roxo-escuro); font-size:1rem; margin-bottom:.4rem"><?php echo e($m->titulo); ?></h3>
                <p style="font-size:.88rem; color:var(--cinza-600)"><?php echo e(Str::limit($m->descricao, 100)); ?></p>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div><?php echo e($materiais->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/materiais/index.blade.php ENDPATH**/ ?>