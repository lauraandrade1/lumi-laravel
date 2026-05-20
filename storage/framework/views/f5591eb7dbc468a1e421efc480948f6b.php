<?php $__env->startSection('title', 'Exercícios'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Exercícios</h1>
        <p style="color:var(--cinza-600)"><?php echo e($exercicios->total()); ?> exercícios cadastrados</p>
    </div>
    <a href="<?php echo e(route('admin.exercicios.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Exercício
    </a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Duração</th>
                    <th>Ordem</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $exercicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($ex->titulo); ?></strong></td>
                    <td><span class="badge badge-purple"><?php echo e(ucfirst($ex->categoria)); ?></span></td>
                    <td><?php echo e($ex->duracao_minutos); ?> min</td>
                    <td><?php echo e($ex->ordem); ?></td>
                    <td><span class="badge <?php echo e($ex->ativo?'badge-green':'badge-red'); ?>"><?php echo e($ex->ativo?'Ativo':'Inativo'); ?></span></td>
                    <td>
                        <div class="table-actions">
                            <a href="<?php echo e(route('admin.exercicios.edit', $ex->id)); ?>" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <form action="<?php echo e(route('admin.exercicios.destroy', $ex->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)" data-confirm="Excluir exercício <?php echo e($ex->titulo); ?>?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum exercício cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div><?php echo e($exercicios->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/exercicios/index.blade.php ENDPATH**/ ?>