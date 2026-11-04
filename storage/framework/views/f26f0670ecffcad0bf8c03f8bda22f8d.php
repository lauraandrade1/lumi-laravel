<?php $__env->startSection('title', $psicologo->nome); ?>
<?php $__env->startSection('content'); ?>
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div class="card">
        <div class="card-body" style="text-align:center;padding:2.5rem">
            <?php if($psicologo->foto): ?>
                <img src="<?php echo e($psicologo->foto_url); ?>" style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:4px solid var(--roxo-palido);margin-bottom:1rem">
            <?php else: ?>
                <div style="width:110px;height:110px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:#fff;font-weight:700;margin:0 auto 1rem">
                    <?php echo e(strtoupper(substr($psicologo->nome,0,1))); ?>

                </div>
            <?php endif; ?>
            <h1 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.8rem;margin-bottom:.4rem"><?php echo e($psicologo->nome); ?></h1>
            <span class="crp-badge" style="font-size:.85rem"><i class="fas fa-id-card"></i> CRP <?php echo e($psicologo->crp_formatado); ?></span>
        </div>
        <div style="padding:0 2rem 2rem">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:2rem">
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Especialidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e($psicologo->especialidade); ?></div>
                </div>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Modalidade</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e(ucfirst($psicologo->modalidade)); ?></div>
                </div>
                <?php if($psicologo->cidade): ?>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Localização</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)"><?php echo e($psicologo->cidade); ?>, <?php echo e($psicologo->estado); ?></div>
                </div>
                <?php endif; ?>
                <?php if($psicologo->valor_consulta): ?>
                <div style="background:var(--roxo-muitoclaro);border-radius:var(--raio);padding:1rem">
                    <div style="font-size:.72rem;font-weight:700;color:var(--roxo-principal);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.3rem">Valor/sessão</div>
                    <div style="font-weight:500;color:var(--roxo-escuro)">R$ <?php echo e(number_format($psicologo->valor_consulta,2,',','.')); ?></div>
                </div>
                <?php endif; ?>
            </div>
            <h3 style="color:var(--roxo-escuro);margin-bottom:.75rem">Sobre</h3>
            <p style="color:var(--cinza-600);line-height:1.8;margin-bottom:2rem"><?php echo e($psicologo->bio); ?></p>
            <?php if($psicologo->telefone): ?>
            <div style="margin-bottom:1.5rem">
                <a href="https://wa.me/55<?php echo e(preg_replace('/\D/','',$psicologo->telefone)); ?>" target="_blank" class="btn btn-secondary btn-lg" style="width:100%;display:block;text-align:center;margin-bottom:.75rem">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <form action="<?php echo e(route('chat.abrir')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="destinatario_id" value="<?php echo e($psicologo->id); ?>">
                <input type="hidden" name="destinatario_tipo" value="psicologo">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/psicologos/show.blade.php ENDPATH**/ ?>