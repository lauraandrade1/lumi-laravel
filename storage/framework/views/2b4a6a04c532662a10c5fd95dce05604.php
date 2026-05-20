<?php $__env->startSection('title', 'Editar Material'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:640px">
    <a href="<?php echo e(route('admin.materiais.index')); ?>" class="btn btn-ghost btn-sm" style="margin-bottom:1.5rem">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
    <div class="card">
        <div class="card-header">
            <h2 style="font-family:var(--fonte-titulo); color:var(--roxo-escuro)">
                <i class="fas fa-pen" style="color:var(--roxo-principal)"></i> Editar: <?php echo e($material->titulo); ?>

            </h2>
        </div>
        <div class="card-body">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-triangle-exclamation"></i>
                <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.materiais.update', $material->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" class="form-control" value="<?php echo e(old('titulo', $material->titulo)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Tipo *</label>
                    <select name="tipo" class="form-select" required>
                        <?php $__currentLoopData = ['artigo'=>'Artigo','video'=>'Vídeo','workbook'=>'Workbook','podcast'=>'Podcast']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($val); ?>" <?php echo e($material->tipo==$val?'selected':''); ?>><?php echo e($lbl); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" class="form-textarea" rows="4" required><?php echo e(old('descricao', $material->descricao)); ?></textarea>
                </div>
                <div class="form-group">
                    <label>URL do conteúdo</label>
                    <input type="url" name="url" class="form-control" value="<?php echo e(old('url', $material->url)); ?>" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:.5rem; cursor:pointer">
                        <input type="checkbox" name="ativo" value="1" <?php echo e(old('ativo', $material->ativo) ? 'checked' : ''); ?>>
                        Material ativo
                    </label>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center">
                    <form action="<?php echo e(route('admin.materiais.destroy', $material->id)); ?>" method="POST" style="display:inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" data-confirm="Excluir este material?"><i class="fas fa-trash"></i> Excluir</button>
                    </form>
                    <div style="display:flex; gap:1rem">
                        <a href="<?php echo e(route('admin.materiais.index')); ?>" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/admin/materiais/edit.blade.php ENDPATH**/ ?>