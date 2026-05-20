<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>Dashboard</h1>
    <p style="color:var(--cinza-600)">Bem-vindo ao painel administrativo da Lumi, <?php echo e(Auth::user()->nome); ?>!</p>
</div>


<div class="stats-grid">
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">👤</div>
        <div class="stat-value"><?php echo e($stats['usuarios']); ?></div>
        <div class="stat-label">Usuários Cadastrados</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">✅</div>
        <div class="stat-value" style="color:var(--verde)"><?php echo e($stats['psicologos_aprovados']); ?></div>
        <div class="stat-label">Psicólogos Aprovados</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">⏳</div>
        <div class="stat-value" style="color:var(--amarelo)"><?php echo e($stats['psicologos_pendentes']); ?></div>
        <div class="stat-label">Aguardando Aprovação</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">📖</div>
        <div class="stat-value"><?php echo e($stats['entradas_diario']); ?></div>
        <div class="stat-label">Entradas no Diário</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">🧘</div>
        <div class="stat-value"><?php echo e($stats['exercicios']); ?></div>
        <div class="stat-label">Exercícios</div>
    </div>
    <div class="stat-card">
        <div style="font-size:2rem; margin-bottom:.5rem">📚</div>
        <div class="stat-value"><?php echo e($stats['materiais']); ?></div>
        <div class="stat-label">Materiais</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem">

    
    <div class="card">
        <div class="card-header" style="display:flex; align-items:center; justify-content:space-between">
            <h3 style="color:var(--roxo-escuro)"><i class="fas fa-clock" style="color:var(--amarelo)"></i> Psicólogos Pendentes</h3>
            <a href="<?php echo e(route('admin.psicologos.index', ['status'=>'pendente'])); ?>" class="btn btn-ghost btn-sm">Ver todos</a>
        </div>
        <div class="card-body" style="padding:0">
            <?php $__empty_1 = true; $__currentLoopData = $psicologosPendentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="padding:1rem 1.5rem; border-bottom:1px solid var(--cinza-200); display:flex; align-items:center; justify-content:space-between">
                <div>
                    <div style="font-weight:600; color:var(--cinza-800)"><?php echo e($p->nome); ?></div>
                    <div style="font-size:.82rem; color:var(--cinza-600)">CRP <?php echo e($p->crp); ?> — <?php echo e($p->especialidade); ?></div>
                </div>
                <div style="display:flex; gap:.4rem">
                    <form action="<?php echo e(route('admin.psicologos.aprovar', $p->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="acao" value="aprovado">
                        <button type="submit" class="btn btn-primary btn-sm" title="Aprovar">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <form action="<?php echo e(route('admin.psicologos.aprovar', $p->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="acao" value="rejeitado">
                        <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="padding:2rem; text-align:center; color:var(--cinza-600); font-size:.92rem">
                <i class="fas fa-circle-check" style="color:var(--verde); font-size:1.5rem; display:block; margin-bottom:.5rem"></i>
                Nenhuma candidatura pendente!
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header" style="display:flex; align-items:center; justify-content:space-between">
            <h3 style="color:var(--roxo-escuro)"><i class="fas fa-user-plus" style="color:var(--verde)"></i> Usuários Recentes</h3>
            <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="btn btn-ghost btn-sm">Ver todos</a>
        </div>
        <div class="card-body" style="padding:0">
            <?php $__currentLoopData = $usuariosRecentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="padding:1rem 1.5rem; border-bottom:1px solid var(--cinza-200); display:flex; align-items:center; gap:.75rem">
                <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-weight:700; font-size:.9rem; flex-shrink:0">
                    <?php echo e(strtoupper(substr($u->nome,0,1))); ?>

                </div>
                <div style="flex:1; min-width:0">
                    <div style="font-weight:600; color:var(--cinza-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis"><?php echo e($u->nome); ?></div>
                    <div style="font-size:.8rem; color:var(--cinza-600)"><?php echo e($u->created_at->diffForHumans()); ?></div>
                </div>
                <span class="badge <?php echo e($u->ativo ? 'badge-green' : 'badge-red'); ?>"><?php echo e($u->ativo?'Ativo':'Inativo'); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>