<?php $__env->startSection('title', 'Psicólogos'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>Psicólogos</h1>
    <p style="color:var(--cinza-600)"><?php echo e($psicologos->total()); ?> psicólogos no total</p>
</div>

<form method="GET" style="display:flex; gap:.75rem; margin-bottom:1.5rem; flex-wrap:wrap; align-items:flex-end">
    <div class="form-group" style="margin:0; flex:1; min-width:200px">
        <input type="text" name="busca" class="form-control" placeholder="Nome, CRP ou e-mail..." value="<?php echo e(request('busca')); ?>">
    </div>
    <div class="form-group" style="margin:0">
        <select name="status" class="form-select">
            <option value="">Todos os status</option>
            <option value="pendente"  <?php echo e(request('status')=='pendente' ?'selected':''); ?>>Pendentes</option>
            <option value="aprovado"  <?php echo e(request('status')=='aprovado' ?'selected':''); ?>>Aprovados</option>
            <option value="rejeitado" <?php echo e(request('status')=='rejeitado'?'selected':''); ?>>Rejeitados</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
    <a href="<?php echo e(route('admin.psicologos.index')); ?>" class="btn btn-ghost">Limpar</a>
</form>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CRP</th>
                    <th>E-mail</th>
                    <th>Especialidade</th>
                    <th>Status</th>
                    <th>Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $psicologos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:.6rem">
                            <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro)); display:flex; align-items:center; justify-content:center; color:var(--branco); font-size:.8rem; font-weight:700; flex-shrink:0">
                                <?php echo e(strtoupper(substr($p->nome,0,1))); ?>

                            </div>
                            <span style="font-weight:500"><?php echo e($p->nome); ?></span>
                        </div>
                    </td>
                    <td><span class="crp-badge"><?php echo e($p->crp_formatado); ?></span></td>
                    <td style="font-size:.85rem; color:var(--cinza-600)"><?php echo e($p->email); ?></td>
                    <td><span class="badge badge-purple"><?php echo e($p->especialidade); ?></span></td>
                    <td>
                        <?php if($p->isPendente()): ?>  <span class="badge badge-yellow">⏳ Pendente</span>
                        <?php elseif($p->isAprovado()): ?> <span class="badge badge-green">✅ Aprovado</span>
                        <?php else: ?> <span class="badge badge-red">❌ Rejeitado</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:.85rem; color:var(--cinza-600)"><?php echo e($p->created_at->format('d/m/Y')); ?></td>
                    <td>
                        <div class="table-actions">
                            <?php if($p->isPendente()): ?>
                            <form action="<?php echo e(route('admin.psicologos.aprovar', $p->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="acao" value="aprovado">
                                <button type="submit" class="btn btn-primary btn-sm" title="Aprovar"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="<?php echo e(route('admin.psicologos.aprovar', $p->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="acao" value="rejeitado">
                                <button type="submit" class="btn btn-danger btn-sm" title="Rejeitar"><i class="fas fa-xmark"></i></button>
                            </form>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.psicologos.show', $p->id)); ?>" class="btn btn-ghost btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('admin.psicologos.edit', $p->id)); ?>" class="btn btn-ghost btn-sm" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="<?php echo e(route('admin.psicologos.destroy', $p->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--vermelho)"
                                    data-confirm="Excluir psicólogo <?php echo e($p->nome); ?>?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" style="text-align:center; color:var(--cinza-600); padding:3rem">Nenhum psicólogo encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div><?php echo e($psicologos->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/psicologos/index.blade.php ENDPATH**/ ?>