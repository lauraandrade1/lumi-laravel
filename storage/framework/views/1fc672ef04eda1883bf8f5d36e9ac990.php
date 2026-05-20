<?php $__env->startSection('title', $psicologo->nome); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:720px">
    <a href="<?php echo e(route('admin.psicologos.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header" style="background:linear-gradient(135deg,var(--roxo-escuro),var(--roxo-principal)); text-align:center; padding:2rem">
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; color:var(--branco); margin:0 auto .75rem">
                <?php echo e(strtoupper(substr($psicologo->nome,0,1))); ?>

            </div>
            <h2 style="color:var(--branco); font-family:var(--fonte-titulo); margin-bottom:.4rem"><?php echo e($psicologo->nome); ?></h2>
            <span style="background:rgba(255,255,255,.2); color:var(--branco); padding:.25rem .75rem; border-radius:50px; font-size:.85rem; font-weight:600">
                CRP <?php echo e($psicologo->crp_formatado); ?>

            </span>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem">
                <div><span style="font-size:.8rem; color:var(--cinza-600)">E-mail</span><br><strong><?php echo e($psicologo->email); ?></strong></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Especialidade</span><br><span class="badge badge-purple"><?php echo e($psicologo->especialidade); ?></span></div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Status</span><br>
                    <?php if($psicologo->isPendente()): ?> <span class="badge badge-yellow">⏳ Pendente</span>
                    <?php elseif($psicologo->isAprovado()): ?> <span class="badge badge-green">✅ Aprovado</span>
                    <?php else: ?> <span class="badge badge-red">❌ Rejeitado</span>
                    <?php endif; ?>
                </div>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Modalidade</span><br><strong><?php echo e(ucfirst($psicologo->modalidade)); ?></strong></div>
                <?php if($psicologo->cidade): ?><div><span style="font-size:.8rem; color:var(--cinza-600)">Localização</span><br><strong><?php echo e($psicologo->cidade); ?>, <?php echo e($psicologo->estado); ?></strong></div><?php endif; ?>
                <?php if($psicologo->valor_consulta): ?><div><span style="font-size:.8rem; color:var(--cinza-600)">Valor/sessão</span><br><strong>R$ <?php echo e(number_format($psicologo->valor_consulta,2,',','.')); ?></strong></div><?php endif; ?>
                <div><span style="font-size:.8rem; color:var(--cinza-600)">Cadastrado em</span><br><strong><?php echo e($psicologo->created_at->format('d/m/Y H:i')); ?></strong></div>
            </div>

            <div style="margin-bottom:1.5rem">
                <span style="font-size:.8rem; color:var(--cinza-600)">Biografia</span>
                <p style="margin-top:.3rem; line-height:1.7; color:var(--cinza-800)"><?php echo e($psicologo->bio); ?></p>
            </div>

            <div style="display:flex; gap:.75rem; flex-wrap:wrap">
                <?php if($psicologo->isPendente()): ?>
                <form action="<?php echo e(route('admin.psicologos.aprovar', $psicologo->id)); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="acao" value="aprovado">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i> Aprovar</button>
                </form>
                <form action="<?php echo e(route('admin.psicologos.aprovar', $psicologo->id)); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="acao" value="rejeitado">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-xmark"></i> Rejeitar</button>
                </form>
                <?php endif; ?>
                <a href="<?php echo e(route('admin.psicologos.edit', $psicologo->id)); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i> Editar</a>
                <form action="<?php echo e(route('admin.psicologos.destroy', $psicologo->id)); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este psicólogo?"><i class="fas fa-trash"></i> Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/psicologos/show.blade.php ENDPATH**/ ?>