<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Lumi'); ?> - Autoajuda e Bem-Estar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/lumi.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand">
           <img src="<?php echo e(asset('img/logo.png')); ?>" alt="" style="height: 60px;">
        
        </a>

        <button class="navbar-toggle" id="navToggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Início</a></li>
            <li><a href="<?php echo e(route('diario.index')); ?>" class="<?php echo e(request()->routeIs('diario.*') ? 'active' : ''); ?>">Diário Emocional</a></li>
            <li><a href="<?php echo e(route('exercicios.index')); ?>" class="<?php echo e(request()->routeIs('exercicios.*') ? 'active' : ''); ?>">Exercícios</a></li>
            <li><a href="<?php echo e(route('psicologos.index')); ?>" class="<?php echo e(request()->routeIs('psicologos.*') ? 'active' : ''); ?>">Psicólogos</a></li>
            <li><a href="<?php echo e(route('materiais.index')); ?>" class="<?php echo e(request()->routeIs('materiais.*') ? 'active' : ''); ?>">Materiais</a></li>
        </ul>

        <div class="nav-auth">
            <?php if(auth()->guard()->check()): ?>
                <div class="user-menu">
                    <button class="user-menu-btn" id="userMenuBtn">
                        <div class="user-avatar-small"><?php echo e(strtoupper(substr(Auth::user()->nome, 0, 1))); ?></div>
                        <span><?php echo e(explode(' ', Auth::user()->nome)[0]); ?></span>
                        <i class="fas fa-chevron-down fa-xs"></i>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="<?php echo e(route('usuario.perfil')); ?>"><i class="fas fa-user"></i> Meu Perfil</a>
                        <a href="<?php echo e(route('diario.index')); ?>"><i class="fas fa-book-heart"></i> Meu Diário</a>
                        <?php if(Auth::user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-shield-halved"></i> Painel Admin</a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit"><i class="fas fa-right-from-bracket"></i> Sair</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost">Entrar</a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Cadastrar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


<a href="https://www.cvv.org.br/" target="_blank" class="cvv-btn" title="Centro de Valorização da Vida - Ligue 188">
    <i class="fas fa-phone-volume"></i>
    <span>CVV 188</span>
</a>


<?php if(session('success')): ?>
    <div class="flash flash-success" id="flashMsg">
        <i class="fas fa-circle-check"></i>
        <span><?php echo e(session('success')); ?></span>
        <button onclick="this.parentElement.remove()"><i class="fas fa-xmark"></i></button>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="flash flash-error" id="flashMsg">
        <i class="fas fa-circle-xmark"></i>
        <span><?php echo e(session('error')); ?></span>
        <button onclick="this.parentElement.remove()"><i class="fas fa-xmark"></i></button>
    </div>
<?php endif; ?>


<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>


<footer class="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <div class="footer-logo">🧠 Lumi</div>
            <p>Seu espaço de autoajuda e bem-estar emocional. Cuide da sua saúde mental com ferramentas acessíveis e profissionais qualificados.</p>
            <div class="social-links">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Links Rápidos</h4>
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Início</a></li>
                <li><a href="<?php echo e(route('diario.index')); ?>">Diário Emocional</a></li>
                <li><a href="<?php echo e(route('exercicios.index')); ?>">Exercícios</a></li>
                <li><a href="<?php echo e(route('psicologos.index')); ?>">Psicólogos</a></li>
                <li><a href="<?php echo e(route('materiais.index')); ?>">Materiais</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Recursos</h4>
            <ul>
                <li><a href="#">Artigos</a></li>
                <li><a href="#">Vídeos</a></li>
                <li><a href="#">Workbooks</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contato</h4>
            <p><i class="fas fa-envelope"></i> contato@lumi.com.br</p>
            <p><i class="fas fa-phone"></i> (11) 1234-5678</p>
            <p><i class="fas fa-map-marker-alt"></i> São Paulo, SP – Brasil</p>
            <p class="crisis-line"><i class="fas fa-heart"></i> Crise? Ligue <strong>188</strong> (CVV)</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo e(date('Y')); ?> Lumi. Todos os direitos reservados. Projeto acadêmico – UNIFRAN.</p>
    </div>
</footer>

<script src="<?php echo e(asset('js/lumi.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Laurinha\Downloads\lumi-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>