// ═══════════════════════════════════════════════════════════
// LUMI — JS Principal
// ═══════════════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', () => {

    // ── Navbar toggle mobile ─────────────────────────────────
    const navToggle = document.getElementById('navToggle');
    const navLinks  = document.getElementById('navLinks');
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', () => navLinks.classList.toggle('open'));
    }

    // ── User dropdown ────────────────────────────────────────
    const userMenuBtn  = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('open');
        });
        document.addEventListener('click', () => userDropdown.classList.remove('open'));
    }

    // ── Auto-dismiss flash message ───────────────────────────
    const flash = document.getElementById('flashMsg');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity .5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 4000);
    }

    // ── Chips de humor no diário ─────────────────────────────
    document.querySelectorAll('.humor-chip').forEach(chip => {
        chip.addEventListener('click', () => {
            document.querySelectorAll('.humor-chip').forEach(c => c.classList.remove('selected'));
            chip.classList.add('selected');
            const input = document.getElementById('nivel_humor');
            if (input) input.value = chip.dataset.val;
        });
    });

    // ── Validação AJAX do CRP ────────────────────────────────
    const crpInput    = document.getElementById('crp');
    const crpFeedback = document.getElementById('crpFeedback');

    if (crpInput && crpFeedback) {
        let timeout;
        crpInput.addEventListener('input', () => {
            clearTimeout(timeout);
            const val = crpInput.value.trim();

            if (val.length < 4) {
                crpFeedback.className = 'crp-feedback';
                crpFeedback.textContent = '';
                return;
            }

            crpFeedback.className = 'crp-feedback checando';
            crpFeedback.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verificando...';

            timeout = setTimeout(async () => {
                try {
                    const url = new URL('/psicologos/validar-crp', window.location.origin);
                    url.searchParams.set('crp', val);
                    const res  = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    const data = await res.json();

                    crpFeedback.className = `crp-feedback ${data.valido ? 'ok' : 'erro'}`;
                    crpFeedback.innerHTML = (data.valido ? '<i class="fas fa-circle-check"></i> ' : '<i class="fas fa-circle-xmark"></i> ') + data.mensagem;
                } catch {
                    crpFeedback.className = 'crp-feedback';
                    crpFeedback.textContent = '';
                }
            }, 600);
        });
    }

    // ── Confirmação de exclusão ──────────────────────────────
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const msg = btn.dataset.confirm || 'Tem certeza que deseja excluir?';
            if (!confirm(msg)) e.preventDefault();
        });
    });

    // ── Tags de emoção no diário ─────────────────────────────
    document.querySelectorAll('.emocao-tag-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('selected');
            updateEmocoesTags();
        });
    });

    function updateEmocoesTags() {
        const selecionadas = [...document.querySelectorAll('.emocao-tag-btn.selected')]
            .map(b => b.dataset.tag);
        const input = document.getElementById('emocoes_tags_input');
        if (input) input.value = JSON.stringify(selecionadas);
    }

    // ── Contador de caracteres na bio ─────────────────────────
    const bioArea = document.getElementById('bio');
    const bioCounter = document.getElementById('bioCounter');
    if (bioArea && bioCounter) {
        const update = () => {
            const len = bioArea.value.length;
            bioCounter.textContent = `${len} / 2000`;
            bioCounter.style.color = len < 50 ? 'var(--vermelho)' : 'var(--cinza-600)';
        };
        bioArea.addEventListener('input', update);
        update();
    }

    // ── Tabela admin: selecionar todos ───────────────────────
    const selectAll = document.getElementById('selectAll');
    if (selectAll) {
        selectAll.addEventListener('change', () => {
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = selectAll.checked);
        });
    }

    // ── Preview de imagem no upload ──────────────────────────
    const fotoInput   = document.getElementById('foto_upload');
    const fotoPreview = document.getElementById('fotoPreview');
    if (fotoInput && fotoPreview) {
        fotoInput.addEventListener('change', () => {
            const file = fotoInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => { fotoPreview.src = e.target.result; fotoPreview.style.display = 'block'; };
                reader.readAsDataURL(file);
            }
        });
    }

    // ── Scroll reveal ────────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
});
