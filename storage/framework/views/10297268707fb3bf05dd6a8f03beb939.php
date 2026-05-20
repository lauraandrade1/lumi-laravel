<?php $__env->startSection('title', 'Editar Perfil'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:640px; margin:3rem auto; padding:0 1.5rem">
    <a href="<?php echo e(route('usuario.perfil')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar ao Perfil
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar Perfil
            </h2>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('usuario.update')); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome completo *</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo e(old('nome', $usuario->nome)); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail *</label>
                        <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $usuario->email)); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?php echo e(old('telefone', $usuario->telefone)); ?>">
                    </div>
                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control"
                            value="<?php echo e(old('data_nascimento', $usuario->data_nascimento?->format('Y-m-d'))); ?>">
                    </div>
                </div>

                <hr style="border-color:var(--cinza-400); margin:1.5rem 0">
                <h4 style="color:var(--cinza-800); font-size:.95rem; margin-bottom:1rem">Alterar Senha <span style="font-weight:400; color:var(--cinza-600)">(deixe em branco para manter)</span></h4>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nova Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="Mín. 8 caracteres">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Nova Senha</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:1rem; margin-top:.5rem">
                    <a href="<?php echo e(route('usuario.perfil')); ?>" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Salvar Alterações
                    </button>
                </div>
            </form>

            <hr style="border-color:var(--cinza-400); margin:2rem 0">
            <details>
                <summary style="cursor:pointer; color:var(--vermelho); font-size:.9rem; font-weight:600">
                    <i class="fas fa-triangle-exclamation"></i> Zona de Perigo — Excluir Conta
                </summary>
                <div style="margin-top:1rem; padding:1rem; background:#fef2f2; border-radius:var(--raio); border:1px solid #fecaca">
                    <p style="font-size:.88rem; color:#991b1b; margin-bottom:1rem">Esta ação é irreversível. Todos os seus dados, incluindo entradas do diário, serão excluídos permanentemente.</p>
                    <form action="<?php echo e(route('usuario.destroy')); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <div class="form-group">
                            <label style="font-size:.88rem">Confirme sua senha para continuar</label>
                            <input type="password" name="password" class="form-control" required placeholder="Sua senha atual">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm"
                            data-confirm="ATENÇÃO: Isso vai excluir sua conta permanentemente. Tem certeza absoluta?">
                            <i class="fas fa-trash"></i> Excluir minha conta
                        </button>
                    </form>
                </div>
            </details>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/usuario/edit.blade.php ENDPATH**/ ?>