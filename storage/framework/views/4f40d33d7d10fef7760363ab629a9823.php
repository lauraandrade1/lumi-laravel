<?php $__env->startSection('title', 'Entrar'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">🧠</div>
        <h1>Bem-vindo de volta</h1>
        <p class="auth-subtitle">Entre na sua conta Lumi</p>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <i class="fas fa-triangle-exclamation"></i>
            <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login.post')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('email')); ?>" placeholder="seu@email.com" required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error-msg"><i class="fas fa-circle-xmark"></i> <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Sua senha" required>
            </div>
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem">
                <label style="display:flex; align-items:center; gap:.4rem; font-size:.9rem; cursor:pointer">
                    <input type="checkbox" name="remember"> Lembrar de mim
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-right-to-bracket"></i> Entrar
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; font-size:.92rem; color:var(--cinza-600)">
            Não tem uma conta?
            <a href="<?php echo e(route('register')); ?>" style="font-weight:600">Cadastre-se grátis</a>
        </p>
        <p style="text-align:center; margin-top:.75rem">
            <a href="<?php echo e(route('home')); ?>" style="font-size:.88rem; color:var(--cinza-600)">
                <i class="fas fa-arrow-left"></i> Voltar para o início
            </a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>