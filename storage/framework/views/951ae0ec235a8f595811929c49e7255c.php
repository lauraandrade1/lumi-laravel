<?php $__env->startSection('title', 'Conversa'); ?>
<?php $__env->startSection('content'); ?>
<div style="max-width:760px;margin:2rem auto;padding:0 1.5rem">
    <?php $dest = $chat->destinatario; $userId = auth()->id(); ?>

    
    <div style="background:var(--branco);border-radius:var(--raio-lg);padding:1.25rem 1.5rem;border:1px solid var(--roxo-palido);box-shadow:var(--sombra-sm);display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
        <a href="<?php echo e(route('chat.index')); ?>" style="color:var(--roxo-principal);margin-right:.25rem"><i class="fas fa-arrow-left"></i></a>
        <?php if($dest && $dest->foto): ?>
            <img src="<?php echo e($dest->foto_url); ?>" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid var(--roxo-palido)">
        <?php else: ?>
            <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--roxo-principal),var(--roxo-claro));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">
                <?php echo e($dest ? strtoupper(substr($dest->nome,0,1)) : '?'); ?>

            </div>
        <?php endif; ?>
        <div>
            <div style="font-weight:600;color:var(--roxo-escuro)"><?php echo e($dest?->nome ?? 'Usuário removido'); ?></div>
            <span class="badge badge-<?php echo e($chat->destinatario_tipo == 'psicologo' ? 'purple' : 'gray'); ?>" style="font-size:.68rem">
                <?php echo e($chat->destinatario_tipo == 'psicologo' ? 'Psicólogo(a)' : 'Estudante de Psicologia'); ?>

            </span>
        </div>
    </div>

    
    <div id="msgBox" style="background:var(--branco);border-radius:var(--raio-lg);padding:1.5rem;border:1px solid var(--roxo-palido);min-height:380px;max-height:500px;overflow-y:auto;margin-bottom:1rem;display:flex;flex-direction:column;gap:.75rem">
        <?php if($chat->mensagens->isEmpty()): ?>
        <div style="text-align:center;color:var(--cinza-500);margin:auto">
            <i class="fas fa-comment-dots" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:.75rem"></i>
            Nenhuma mensagem ainda. Diga olá!
        </div>
        <?php else: ?>
        <?php $__currentLoopData = $chat->mensagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $isMe = ($msg->remetente_tipo === 'usuario' && $msg->remetente_id == $userId); ?>
        <div style="display:flex;flex-direction:column;align-items:<?php echo e($isMe ? 'flex-end' : 'flex-start'); ?>">
            <?php if(!$isMe): ?>
            <div style="font-size:.72rem;color:var(--cinza-500);margin-bottom:.2rem;padding-left:.25rem"><?php echo e($msg->remetente_nome); ?></div>
            <?php endif; ?>
            <div style="max-width:72%;padding:.75rem 1rem;border-radius:<?php echo e($isMe ? '18px 18px 4px 18px' : '18px 18px 18px 4px'); ?>;background:<?php echo e($isMe ? 'var(--roxo-principal)' : 'var(--roxo-muitoclaro)'); ?>;color:<?php echo e($isMe ? '#fff' : 'var(--roxo-escuro)'); ?>;font-size:.9rem;line-height:1.5;word-break:break-word">
                <?php echo e($msg->conteudo); ?>

            </div>
            <div style="font-size:.68rem;color:var(--cinza-400);margin-top:.2rem;padding:0 .25rem">
                <?php echo e($msg->created_at->format('d/m H:i')); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>

    
    <?php if($errors->has('conteudo')): ?>
    <div class="alert alert-danger" style="margin-bottom:.75rem"><i class="fas fa-triangle-exclamation"></i> <?php echo e($errors->first('conteudo')); ?></div>
    <?php endif; ?>
    <form action="<?php echo e(route('chat.enviar',$chat->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div style="display:flex;gap:.75rem;align-items:flex-end">
            <textarea name="conteudo" rows="2" placeholder="Digite sua mensagem..." required maxlength="2000"
                style="flex:1;padding:.75rem 1rem;border-radius:var(--raio-lg);border:1.5px solid var(--roxo-palido);font-family:inherit;font-size:.9rem;resize:none;outline:none;transition:border-color .2s"
                onfocus="this.style.borderColor='var(--roxo-principal)'" onblur="this.style.borderColor='var(--roxo-palido)'"
                onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();this.closest('form').submit();}"></textarea>
            <button type="submit" class="btn btn-primary" style="padding:.75rem 1.25rem;border-radius:var(--raio-lg)">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <p style="font-size:.72rem;color:var(--cinza-500);margin-top:.4rem">Enter para enviar · Shift+Enter para nova linha</p>
    </form>
</div>
<script>
    const box = document.getElementById('msgBox');
    if(box) box.scrollTop = box.scrollHeight;
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/chat/show.blade.php ENDPATH**/ ?>