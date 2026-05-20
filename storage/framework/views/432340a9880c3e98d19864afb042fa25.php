<?php $__env->startSection('title', 'Editar Usuário'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:640px">
    <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar Usuário: <?php echo e($usuario->nome); ?>

            </h2>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.usuarios.update', $usuario->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome *</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo e(old('nome', $usuario->nome)); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $usuario->email)); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo *</label>
                        <select name="tipo" class="form-select" required>
                            <option value="usuario" <?php echo e($usuario->tipo=='usuario'?'selected':''); ?>>Usuário</option>
                            <option value="admin"   <?php echo e($usuario->tipo=='admin'?'selected':''); ?>>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="ativo" class="form-select">
                            <option value="1" <?php echo e($usuario->ativo?'selected':''); ?>>Ativo</option>
                            <option value="0" <?php echo e(!$usuario->ativo?'selected':''); ?>>Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nova Senha <span style="font-weight:400; color:var(--cinza-600)">(deixe vazio para manter)</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (opcional)">
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem">
                    <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/usuarios/edit.blade.php ENDPATH**/ ?>