<?php $__env->startSection('title', 'Ver Usuário'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:640px">
    <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header" style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); text-align:center; padding:2rem">
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; color:var(--branco); margin:0 auto .75rem">
                <?php echo e(strtoupper(substr($usuario->nome,0,1))); ?>

            </div>
            <h2 style="color:var(--branco); font-family:var(--fonte-titulo)"><?php echo e($usuario->nome); ?></h2>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
                <div><span style="font-size:.8rem; color:var(--cinza-600)">E-mail</span><br><strong><?php echo e($usuario->email); ?></strong></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Tipo</span><br><span class="badge <?php echo e($usuario->tipo=='admin'?'badge-purple':'badge-gray'); ?>"><?php echo e(ucfirst($usuario->tipo)); ?></span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Status</span><br><span class="badge <?php echo e($usuario->ativo?'badge-green':'badge-red'); ?>"><?php echo e($usuario->ativo?'Ativo':'Inativo'); ?></span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Cadastrado em</span><br><strong><?php echo e($usuario->created_at->format('d/m/Y H:i')); ?></strong></div>
                <?php if($usuario->telefone): ?><div><span style="font-size:.8rem; color:var(--cinza-600)">Telefone</span><br><strong><?php echo e($usuario->telefone); ?></strong></div><?php endif; ?>
                <?php if($usuario->data_nascimento): ?><div><span style="font-size:.8rem; color:var(--cinza-600)">Nascimento</span><br><strong><?php echo e($usuario->data_nascimento->format('d/m/Y')); ?></strong></div><?php endif; ?>
            </div>
            <div style="display:flex; gap:.75rem; margin-top:1.5rem">
                <a href="<?php echo e(route('admin.usuarios.edit', $usuario->id)); ?>" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Editar</a>
                <form action="<?php echo e(route('admin.usuarios.destroy', $usuario->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este usuário?"><i class="fas fa-trash"></i> Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/usuarios/show.blade.php ENDPATH**/ ?>