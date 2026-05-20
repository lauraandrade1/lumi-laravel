<?php $__env->startSection('title', $psicologo->nome); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:800px; margin:3rem auto; padding:0 1.5rem">

    <a href="<?php echo e(route('psicologos.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar para a lista
    </a>

    <div class="card">
        <div class="card-header" style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); padding:2.5rem; text-align:center">
            <div class="psicologo-avatar" style="width:100px;height:100px;font-size:2.5rem">
                <?php echo e(strtoupper(substr($psicologo->nome, 0, 1))); ?>

            </div>
            <h1 style="font-family:var(--fonte-titulo); color:var(--branco); font-size:1.8rem; margin:.75rem 0 .4rem">
                <?php echo e($psicologo->nome); ?>

            </h1>
            <span class="crp-badge" style="background:rgba(255,255,255,.2); color:var(--branco)">
                <i class="fas fa-id-card"></i> CRP <?php echo e($psicologo->crp_formatado); ?>

            </span>
        </div>

        <div class="card-body" style="padding:2rem">
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1.5rem; margin-bottom:2rem">
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.5rem; margin-bottom:.3rem">🧠</div>
                    <div style="font-size:.8rem; color:var(--cinza-600); margin-bottom:.2rem">Especialidade</div>
                    <div style="font-weight:600; color:var(--roxo-escuro); font-size:.92rem"><?php echo e($psicologo->especialidade); ?></div>
                </div>
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.5rem; margin-bottom:.3rem">💻</div>
                    <div style="font-size:.8rem; color:var(--cinza-600); margin-bottom:.2rem">Modalidade</div>
                    <div style="font-weight:600; color:var(--roxo-escuro); font-size:.92rem"><?php echo e(ucfirst($psicologo->modalidade)); ?></div>
                </div>
                <?php if($psicologo->valor_consulta): ?>
                <div style="text-align:center; padding:1rem; background:var(--roxo-muitoclaro); border-radius:var(--raio)">
                    <div style="font-size:1.5rem; margin-bottom:.3rem">💰</div>
                    <div style="font-size:.8rem; color:var(--cinza-600); margin-bottom:.2rem">Valor/sessão</div>
                    <div style="font-weight:600; color:var(--roxo-escuro); font-size:.92rem">R$ <?php echo e(number_format($psicologo->valor_consulta,2,',','.')); ?></div>
                </div>
                <?php endif; ?>
            </div>

            <h3 style="color:var(--roxo-escuro); margin-bottom:.75rem; font-family:var(--fonte-titulo)">Sobre o profissional</h3>
            <p style="color:var(--cinza-600); line-height:1.8; margin-bottom:2rem"><?php echo e($psicologo->bio); ?></p>

            <?php if($psicologo->cidade): ?>
            <p style="color:var(--cinza-600); margin-bottom:1.5rem">
                <i class="fas fa-map-marker-alt" style="color:var(--roxo-principal)"></i>
                <?php echo e($psicologo->cidade); ?>, <?php echo e($psicologo->estado); ?>

            </p>
            <?php endif; ?>

            <?php if($psicologo->telefone): ?>
            <a href="https://wa.me/<?php echo e(preg_replace('/\D/','',$psicologo->telefone)); ?>" target="_blank" class="btn btn-primary btn-lg">
                <i class="fab fa-whatsapp"></i> Entrar em contato via WhatsApp
            </a>
            <?php else: ?>
            <a href="mailto:<?php echo e($psicologo->email); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope"></i> Entrar em contato por E-mail
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/psicologos/show.blade.php ENDPATH**/ ?>