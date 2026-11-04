<?php $__env->startSection('title', 'Minhas Conversas'); ?>
<?php $__env->startSection('content'); ?>
<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
        <h2 style="font-family:var(--fonte-titulo);color:var(--roxo-escuro);font-size:1.6rem"><i class="fas fa-comments" style="color:var(--roxo-principal)"></i> Minhas Conversas</h2>
    </div>

    <?php if($chats->isEmpty()): ?>
    <div style="text-align:center;padding:4rem;color:var(--cinza-600)">
        <div style="font-size:4rem;margin-bottom:1rem;opacity:.3">💬</div>
        <h3 style="margin-bottom:.5rem">Nenhuma conversa ainda</h3>
        <p style="margin-bottom:1.5rem">Acesse o perfil de um psicólogo ou estudante para iniciar uma conversa.</p>
        <a href="<?php echo e(route('psicologos.index')); ?>" class="btn btn-primary">Ver Profissionais</a>
    </div>
    <?php else: ?>
    <div style="display:flex;flex-direction:column;gap:.75rem">
        <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $dest = $chat->destinatario; $ultima = $chat->ultimaMensagem; ?>
        <a href="<?php echo e(route('chat.show',$chat->id)); ?>" style="text-decoration:none">
            <div style="background:var(--branco);border-radius:var(--raio-lg);padding:1.25rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm);display:flex;align-items:center;gap:1rem;transition:all .2s"
                onmouseover="this.style.borderColor='var(--roxo-principal)';this.style.boxShadow='var(--sombra-md)'"
                onmouseout="this.style.borderColor='var(--roxo-palido)';this.style.boxShadow='var(--sombra-sm)'">
                <?php if($dest && $dest->foto): ?>
                    <img src="<?php echo e($dest->foto_url); ?>" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid var(--roxo-palido);flex-shrink:0">
                <?php else: ?>
                    <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;font-weight:700;flex-shrink:0">
                        <?php echo e($dest ? strtoupper(substr($dest->nome,0,1)) : '?'); ?>

                    </div>
                <?php endif; ?>
                <div style="flex:1;min-width:0">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.25rem">
                        <span style="font-weight:600;color:var(--roxo-escuro)"><?php echo e($dest?->nome ?? 'Usuário removido'); ?></span>
                        <span style="font-size:.75rem;color:var(--cinza-500)">
                            <?php echo e($ultima ? $ultima->created_at->diffForHumans() : ''); ?>

                        </span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem">
                        <span class="badge badge-<?php echo e($chat->destinatario_tipo == 'psicologo' ? 'purple' : 'gray'); ?>" style="font-size:.68rem">
                            <?php echo e($chat->destinatario_tipo == 'psicologo' ? 'Psicólogo(a)' : 'Estudante'); ?>

                        </span>
                        <span style="font-size:.85rem;color:var(--cinza-600);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                            <?php echo e($ultima ? Str::limit($ultima->conteudo, 60) : 'Nenhuma mensagem ainda'); ?>

                        </span>
                    </div>
                </div>
                <i class="fas fa-chevron-right" style="color:var(--roxo-claro);flex-shrink:0"></i>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/chat/index.blade.php ENDPATH**/ ?>