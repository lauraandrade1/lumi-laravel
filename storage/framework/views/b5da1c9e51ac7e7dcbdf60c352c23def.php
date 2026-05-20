<?php if($paginator->hasPages()): ?>
<nav class="pagination" role="navigation" aria-label="Paginação">
    
    <?php if($paginator->onFirstPage()): ?>
        <span aria-disabled="true">‹ Anterior</span>
    <?php else: ?>
        <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">‹ Anterior</a>
    <?php endif; ?>

    
    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_string($element)): ?>
            <span><?php echo e($element); ?></span>
        <?php endif; ?>
        <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $paginator->currentPage()): ?>
                    <span class="active" aria-current="page"><span><?php echo e($page); ?></span></span>
                <?php else: ?>
                    <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php if($paginator->hasMorePages()): ?>
        <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Próximo ›</a>
    <?php else: ?>
        <span aria-disabled="true">Próximo ›</span>
    <?php endif; ?>
</nav>
<?php endif; ?>
<?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>