<?php $__env->startSection('title', 'Estudantes de Psicologia'); ?>
<?php $__env->startSection('content'); ?>
<div class="section">
    <h2 class="section-title">Estudantes de Psicologia Parceiros</h2>
    <p class="section-subtitle">Estudantes em formação, supervisionados por profissionais, prontos para oferecer apoio emocional acessível.</p>

    <form method="GET" action="<?php echo e(route('estudantes.index')); ?>" style="background:var(--branco);border-radius:var(--raio-lg);padding:1.5rem;margin-bottom:2rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm)">
        <div style="display:grid;grid-template-columns:2fr 1fr 1fr auto;gap:1rem;align-items:end">
            <div class="form-group" style="margin:0">
                <label>Buscar</label>
                <input type="text" name="busca" class="form-control" placeholder="Nome, área ou cidade..." value="<?php echo e(request('busca')); ?>">
            </div>
            <div class="form-group" style="margin:0">
                <label>Área</label>
                <select name="area" class="form-select">
                    <option value="">Todas</option>
                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($a); ?>" <?php echo e(request('area')==$a?'selected':''); ?>><?php echo e($a); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group" style="margin:0">
                <label>Modalidade</label>
                <select name="modalidade" class="form-select">
                    <option value="">Todas</option>
                    <option value="online"     <?php echo e(request('modalidade')=='online'?'selected':''); ?>>Online</option>
                    <option value="presencial" <?php echo e(request('modalidade')=='presencial'?'selected':''); ?>>Presencial</option>
                    <option value="ambos"      <?php echo e(request('modalidade')=='ambos'?'selected':''); ?>>Ambos</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
        </div>
    </form>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
        <p style="color:var(--cinza-600);font-size:.92rem"><?php echo e($estudantes->total()); ?> estudantes encontrados</p>
        <a href="<?php echo e(route('estudantes.create')); ?>" class="btn btn-secondary">
            <i class="fas fa-graduation-cap"></i> Cadastrar-se como Estudante
        </a>
    </div>

    <?php if($estudantes->isEmpty()): ?>
    <div style="text-align:center;padding:4rem;color:var(--cinza-600)">
        <div style="font-size:4rem;margin-bottom:1rem;opacity:.3">🎓</div>
        <h3 style="margin-bottom:.5rem">Nenhum estudante encontrado</h3>
        <p>Tente ajustar os filtros de busca.</p>
    </div>
    <?php else: ?>
    <div class="psicologos-grid">
        <?php $__currentLoopData = $estudantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="psicologo-card">
            <div class="psicologo-card-header">
                <?php if($e->foto): ?>
                    <img src="<?php echo e($e->foto_url); ?>" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:3px solid var(--roxo-palido);margin-bottom:.75rem">
                <?php else: ?>
                    <div class="psicologo-avatar"><?php echo e(strtoupper(substr($e->nome,0,1))); ?></div>
                <?php endif; ?>
                <h3 style="color:var(--roxo-escuro);margin-bottom:.3rem"><?php echo e($e->nome); ?></h3>
                <span class="badge badge-purple"><i class="fas fa-graduation-cap"></i> <?php echo e($e->semestre); ?></span>
            </div>
            <div class="psicologo-card-body">
                <p style="font-size:.85rem;color:var(--cinza-500);margin-bottom:.4rem"><i class="fas fa-university" style="color:var(--roxo-principal)"></i> <?php echo e($e->instituicao); ?></p>
                <p style="font-size:.9rem;color:var(--cinza-600);margin-bottom:.75rem"><?php echo e(Str::limit($e->bio, 110)); ?></p>
                <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.75rem">
                    <span class="badge badge-purple"><i class="fas fa-brain"></i> <?php echo e($e->area_estudo); ?></span>
                    <span class="badge badge-gray"><?php echo e(ucfirst($e->modalidade)); ?></span>
                </div>
                <?php if($e->cidade): ?>
                <p style="font-size:.85rem;color:var(--cinza-600)"><i class="fas fa-map-marker-alt" style="color:var(--roxo-principal)"></i> <?php echo e($e->cidade); ?>, <?php echo e($e->estado); ?></p>
                <?php endif; ?>
            </div>
            <div class="psicologo-card-footer" style="display:flex;gap:.5rem">
                <a href="<?php echo e(route('estudantes.show',$e->id)); ?>" class="btn btn-primary btn-sm">Ver Perfil</a>
                <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('chat.abrir')); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="destinatario_id" value="<?php echo e($e->id); ?>">
                    <input type="hidden" name="destinatario_tipo" value="estudante">
                    <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-comment"></i> Chat</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div><?php echo e($estudantes->withQueryString()->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/estudantes/index.blade.php ENDPATH**/ ?>