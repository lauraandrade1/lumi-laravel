<?php $__env->startSection('title', 'Usuários'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header" style="display:flex; justify-content:space-between; align-items:flex-start">
    <div>
        <h1>Usuários</h1>
        <p style="color:var(--cinza-600)"><?php echo e($usuarios->total()); ?> usuários cadastrados</p>
    </div>
</div>


<form method="GET" class="search-bar" style="max-width:400px">
    <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou e-mail..." value="<?php echo e(request('busca')); ?>">
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
</form>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Cadastro</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:.8rem; font-weight:700; flex-shrink:0">
                                <?php echo e(strtoupper(substr($u->nome,0,1))); ?>

                            </div>
                            <span style="font-weight:500"><?php echo e($u->nome); ?></span>
                        </div>
                    </td>
                    <td style="color:var(--cinza-600)"><?php echo e($u->email); ?></td>
                    <td style="font-size:.85rem; color:var(--cinza-600)"><?php echo e($u->created_at->format('d/m/Y')); ?></td>
                    <td><span class="badge <?php echo e($u->tipo=='admin'?'badge-purple':'badge-gray'); ?>"><?php echo e(ucfirst($u->tipo)); ?></span></td>
                    <td><span class="badge <?php echo e($u->ativo?'badge-green':'badge-red'); ?>"><?php echo e($u->ativo?'Ativo':'Inativo'); ?></span></td>
                    <td>
                        <div class="table-actions">
                            <a href="<?php echo e(route('admin.usuarios.show', $u->id)); ?>" class="btn btn-ghost btn-sm" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.usuarios.edit', $u->id)); ?>" class="btn btn-ghost btn-sm" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="<?php echo e(route('admin.usuarios.destroy', $u->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir usuário <?php echo e($u->nome); ?>?">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum usuário encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div><?php echo e($usuarios->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/usuarios/index.blade.php ENDPATH**/ ?>