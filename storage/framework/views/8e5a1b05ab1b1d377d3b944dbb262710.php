<?php $__env->startSection('title', $estudante->nome); ?>
<?php $__env->startSection('content'); ?>
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-body" style="text-align:center;padding:2.5rem">
            <?php if($estudante->foto): ?>
                <img src="<?php echo e($estudante->foto_url); ?>" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--roxo-palido);margin-bottom:1rem">
            <?php else: ?>
                <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;font-weight:700;margin:0 auto 1rem">
                    <?php echo e(strtoupper(substr($estudante->nome,0,1))); ?>

                </div>
            <?php endif; ?>
            <h1 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.8rem;margin-bottom:.4rem"><?php echo e($estudante->nome); ?></h1>
            <span class="badge badge-purple" style="font-size:.85rem"><i class="fas fa-graduation-cap"></i> Estudante de Psicologia</span>
        </div>
        <div style="padding:0 2rem 2rem">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:2rem">
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Instituição</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e($estudante->instituicao); ?></div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Semestre</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e($estudante->semestre); ?></div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Área de Interesse</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e($estudante->area_estudo); ?></div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Modalidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e(ucfirst($estudante->modalidade)); ?></div>
                </div>
            </div>
            <h3 style="color:var(--roxo-escuro);margin-bottom:.75rem">Apresentação</h3>
            <p style="color:var(--cinza-600);line-height:1.8;margin-bottom:2rem"><?php echo e($estudante->bio); ?></p>
            <?php if(auth()->guard()->check()): ?>
            <form action="<?php echo e(route('chat.abrir')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="destinatario_id" value="<?php echo e($estudante->id); ?>">
                <input type="hidden" name="destinatario_tipo" value="estudante">
                <button type="submit" class="btn btn-primary btn-lg" style="width:100%">
                    <i class="fas fa-comment"></i> Iniciar Conversa
                </button>
            </form>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg" style="width:100%;display:block;text-align:center">
                <i class="fas fa-sign-in-alt"></i> Faça login para conversar
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/estudantes/show.blade.php ENDPATH**/ ?>