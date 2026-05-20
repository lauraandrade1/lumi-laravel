<?php $__env->startSection('title', 'Materiais'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Materiais Educativos</h1>
        <p style="color:var(--cinza-600)"><?php echo e($materiais->total()); ?> materiais cadastrados</p>
    </div>
    <a href="<?php echo e(route('admin.materiais.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Material
    </a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Visualizações</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <i class="fas <?php echo e($m->tipo_icone); ?>" style="color:var(--roxo-principal); width:18px"></i>
                            <strong><?php echo e($m->titulo); ?></strong>
                        </div>
                    </td>
                    <td><span class="badge badge-purple"><?php echo e($m->tipo_label); ?></span></td>
                    <td style="color:var(--cinza-600)"><i class="fas fa-eye"></i> <?php echo e($m->visualizacoes); ?></td>
                    <td><span class="badge <?php echo e($m->ativo?'badge-green':'badge-red'); ?>"><?php echo e($m->ativo?'Ativo':'Inativo'); ?></span></td>
                    <td style="font-size:.85rem; color:var(--cinza-600)"><?php echo e($m->created_at->format('d/m/Y')); ?></td>
                    <td>
                        <div class="table-actions">
                            <a href="<?php echo e(route('admin.materiais.edit', $m->id)); ?>" class="btn btn-ghost btn-sm"><i class="fas fa-pen"></i></a>
                            <form action="<?php echo e(route('admin.materiais.destroy', $m->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir material <?php echo e($m->titulo); ?>?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum material cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div><?php echo e($materiais->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/materiais/index.blade.php ENDPATH**/ ?>