@extends('layouts.app')
@section('title', 'Início')

@section('content')
{{-- HERO ──────────────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-content">
        <h1 class="fade-in-up">Seu refúgio para o<br>bem-estar emocional</h1>
        <p class="fade-in-up delay-1">Um espaço seguro para cuidar da sua saúde mental com ferramentas de autoajuda, profissionais qualificados e uma comunidade acolhedora.</p>
        <div class="hero-btns fade-in-up delay-2">
            <div class="hero-btns fade-in-up delay-2">
    <a href="{{ route('diario.index') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-book-heart"></i> Começar Diário
    </a>

    <a href="{{ route('exercicios.index') }}" class="btn btn-secondary btn-lg">
        <i class="fas fa-spa"></i> Explorar Exercícios
    </a>
</div>
</section>

           <div class="section">

    <div class="breathing-container">

        <div class="heart-area">
            <p class="breath-label" id="faseTexto">INSPIRE</p>

            <div class="heart-glow">
                <i class="fas fa-heart"></i>
            </div>

            <div class="timer" id="timer">4</div>
        </div>

        <div class="robot-area">

            <div class="robot-message" id="robotMessage">
                Inspire suavemente... ✨
            </div>

            <div class="robot" id="robot">

                <div class="robot-head">
                    <div class="eyes">
                        <span class="eye"></span>
                        <span class="eye"></span>
                    </div>

                    <div class="mouth" id="mouth"></div>
                </div>

                <div class="robot-body"></div>

                <div class="arms">
                    <div class="arm left-arm"></div>
                    <div class="arm right-arm"></div>
                </div>

            </div>

            <h3 id="faseNome">Inspire</h3>

            <div class="breath-buttons">
                <button class="btn-control" id="pauseBtn">Pausar</button>
                <button class="btn-control" id="restartBtn">Reiniciar</button>
            </div>

        </div>

    </div>

</div>

<style>
.breathing-container{
    background:transparent;
    padding:3rem;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:2rem;
    align-items:center;
    color:white;
}

.heart-area{
    text-align:center;
}

.breath-label{
    color:var(--roxo-principal);
    font-weight:700;
    letter-spacing:2px;
    margin-bottom:1.5rem;
}

.heart-glow{
    width:180px;
    height:180px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    animation:pulse 4s infinite ease-in-out;
}

.heart-glow i{
    font-size:8rem;
    color:#b57aff;
     filter:none;
}

.timer{
    margin-top:1rem;
    font-size:4rem;
    font-weight:bold;
    color:#a855f7;
}

@keyframes pulse{
    0%{
        transform:scale(.9);
        filter:drop-shadow(0 0 5px #a855f7);
    }

    50%{
        transform:scale(1.15);
        filter:drop-shadow(0 0 35px #c084fc);
    }

    100%{
        transform:scale(.9);
        filter:drop-shadow(0 0 5px #a855f7);
    }
}

.robot-area{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}

.robot-message{
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(12px);
    border:1px solid rgba(168,85,247,.25);

    color:var(--roxo-escuro);

    padding:1rem 1.5rem;
    border-radius:18px;
    margin-bottom:2rem;

    max-width:320px;
    text-align:center;
    line-height:1.5;
    position:relative;
}

.robot-message::after{
    content:"";
    position:absolute;
    bottom:-10px;
    left:40px;

    border-width:10px;
    border-style:solid;
    border-color:rgba(255,255,255,.05) transparent transparent transparent;
}

.robot{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
}

.robot-head{
    width:110px;
    height:90px;
    border-radius:20px;

    background:#f3e8ff;
    border:3px solid #a855f7;

    position:relative;

    animation:float 2s infinite ease-in-out;
}

.eyes{
    display:flex;
    justify-content:center;
    gap:18px;
    margin-top:24px;
}

.eye{
    width:14px;
    height:14px;

    background:#7e22ce;
    border-radius:50%;

    animation:blink 5s infinite;
}

@keyframes blink{

    0%,45%,47%,100%{
        transform:scaleY(1);
    }

    46%{
        transform:scaleY(.1);
    }

}

.mouth{
    width:35px;
    height:8px;

    background:#7e22ce;
    border-radius:20px;

    position:absolute;
    bottom:18px;
    left:50%;

    transform:translateX(-50%);
    transition:.4s;
}

.robot-body{
    width:80px;
    height:90px;

    background:#f3e8ff;
    border:3px solid #a855f7;

    border-radius:18px;
    margin-top:10px;

    position:relative;
}

.robot-body::before,
.robot-body::after{
    content:"";
    position:absolute;

    width:12px;
    height:12px;

    background:#d8b4fe;
    border-radius:50%;

    top:30px;
}

.robot-body::before{
    left:18px;
}

.robot-body::after{
    right:18px;
}

.arms{
    position:absolute;
    top:100px;

    width:170px;

    display:flex;
    justify-content:space-between;
}

.arm{
    width:20px;
    height:60px;

    background:#f3e8ff;
    border:3px solid #a855f7;

    border-radius:20px;

    animation:armsMove 2s infinite ease-in-out;
}

@keyframes armsMove{

    0%{
        transform:rotate(-10deg);
    }

    50%{
        transform:rotate(10deg);
    }

    100%{
        transform:rotate(-10deg);
    }

}

@keyframes float{

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-8px);
    }

    100%{
        transform:translateY(0);
    }

}

#faseNome{
    margin-top:20px;
    color:var(--roxo-principal);
}

.breath-buttons{
    display:flex;
    gap:1rem;
    margin-top:2rem;
}

.btn-control{
    width:160px;
    height:52px;

    background:rgba(255,255,255,.05);
    backdrop-filter:blur(12px);

    border:1px solid rgba(168,85,247,.25);

    color:var(--roxo-principal);

    border-radius:12px;

    cursor:pointer;
    transition:.3s;
    font-weight:600;
}

.btn-control:hover{
    background:rgba(168,85,247,.15);
    border-color:#a855f7;
}

@media(max-width:900px){

    .breathing-container{
        grid-template-columns:1fr;
        text-align:center;
    }

    .heart-glow i{
        font-size:6rem;
    }

}


</style>
        </div>
    </div>
</section>
<script>

document.addEventListener("DOMContentLoaded", function(){

const fases = [
{
nome:"INSPIRE",
tempo:4,
mensagem:" Inspire profundamente",
boca:"40px"
},
{
nome:"SEGURE",
tempo:2,
mensagem:" Segure o ar",
boca:"30px"
},
{
nome:"EXPIRE",
tempo:6,
mensagem:" Solte a tensão",
boca:"18px"
},
{
nome:"SEGURE",
tempo:2,
mensagem:" Aproveite a calma",
boca:"30px"
}
];

let fase = 0;
let contador = fases[0].tempo;
let pausado = false;

const timer = document.getElementById("timer");
const faseTexto = document.getElementById("faseTexto");
const faseNome = document.getElementById("faseNome");
const mensagem = document.getElementById("robotMessage");
const boca = document.getElementById("mouth");
const coracao = document.querySelector(".heart-glow");

function atualizar(){

let atual = fases[fase];

faseTexto.innerText = atual.nome;
faseNome.innerText = atual.nome;
mensagem.innerHTML = atual.mensagem;

boca.style.width = atual.boca;

if(atual.nome === "INSPIRE"){
coracao.style.transition = "4s linear";
coracao.style.transform = "scale(1.3)";
}
else if(atual.nome === "EXPIRE"){
coracao.style.transition = "6s linear";
coracao.style.transform = "scale(.85)";
}
else{
coracao.style.transition = "2s linear";
coracao.style.transform = "scale(1)";
}

timer.innerText = contador;
}

function proximaFase(){

fase++;

if(fase >= fases.length){
fase = 0;
}

contador = fases[fase].tempo;

atualizar();
}

atualizar();

setInterval(() => {

if(pausado) return;

contador--;

timer.innerText = contador;

if(contador <= 0){
proximaFase();
}

},1000);

document.getElementById("pauseBtn").addEventListener("click",function(){

pausado = !pausado;

this.innerText = pausado
? "Continuar"
: "Pausar";

});

document.getElementById("restartBtn").addEventListener("click",()=>{

fase = 0;
contador = fases[0].tempo;
pausado = false;

document.getElementById("pauseBtn").innerText = "Pausar";

atualizar();

});

});

</script>

{{-- FEATURES ──────────────────────────────────────────────────────────── --}}
<div class="section">
    <h2 class="section-title">Como podemos ajudar</h2>
    <p class="section-subtitle">Ferramentas completas para apoiar sua jornada de autoconhecimento e bem-estar emocional.</p>

    <div class="features-grid">
        <div class="feature-card reveal">
            <div class="feature-icon"><i class="fas fa-book-open"></i></div>
            <h3>Diário Emocional</h3>
            <p>Registre seus pensamentos num espaço privado. Acompanhe seu humor e identifique padrões emocionais ao longo do tempo.</p>
            <a href="{{ route('diario.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Acessar →</a>
        </div>
        <div class="feature-card reveal delay-1">
            <div class="feature-icon"><i class="fas fa-spa"></i></div>
            <h3>Exercícios Guiados</h3>
            <p>Técnicas de respiração, meditação e relaxamento para ajudar no gerenciamento do estresse e ansiedade.</p>
            <a href="{{ route('exercicios.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Explorar →</a>
        </div>
        <div class="feature-card reveal delay-2">
            <div class="feature-icon"><i class="fas fa-user-md"></i></div>
            <h3>Rede de Psicólogos</h3>
            <p>Encontre profissionais qualificados parceiros da Lumi. Agende consultas e receba acompanhamento personalizado.</p>
            <a href="{{ route('psicologos.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Ver Psicólogos →</a>
        </div>
        <div class="feature-card reveal delay-3">
            <div class="feature-icon"><i class="fas fa-download"></i></div>
            <h3>Materiais Educativos</h3>
            <p>Artigos, vídeos e workbooks desenvolvidos por especialistas para enriquecer sua jornada de autoconhecimento.</p>
            <a href="{{ route('materiais.index') }}" class="btn btn-ghost btn-sm" style="margin-top:1rem">Ver Materiais →</a>
        </div>
    </div>
</div>

{{-- PSICÓLOGOS DESTAQUE ────────────────────────────────────────────────── --}}
@if($psicologos->count())
<div style="background: var(--roxo-muitoclaro); padding: 5rem 1.5rem;">
    <div style="max-width:1280px; margin:0 auto">
        <h2 class="section-title">Nossos Psicólogos em Destaque</h2>
        <p class="section-subtitle">Conheça alguns dos profissionais parceiros da Lumi prontos para te apoiar.</p>
        <div class="psicologos-grid">
            @foreach($psicologos as $p)
            <div class="psicologo-card reveal">
                <div class="psicologo-card-header">
                    <div class="psicologo-avatar">{{ strtoupper(substr($p->nome, 0, 1)) }}</div>
                    <h3 style="color:var(--roxo-escuro); margin-bottom:.3rem">{{ $p->nome }}</h3>
                    <span class="crp-badge"><i class="fas fa-id-card"></i> {{ $p->crp_formatado }}</span>
                </div>
                <div class="psicologo-card-body">
                    <p style="font-size:.9rem; color:var(--cinza-600); margin-bottom:.75rem">{{ Str::limit($p->bio, 100) }}</p>
                    <div style="display:flex; gap:.5rem; flex-wrap:wrap">
                        <span class="badge badge-purple">{{ $p->especialidade }}</span>
                        <span class="badge badge-gray">{{ ucfirst($p->modalidade) }}</span>
                    </div>
                </div>
                <div class="psicologo-card-footer">
                    <a href="{{ route('psicologos.show', $p->id) }}" class="btn btn-primary btn-sm">Ver Perfil</a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top:2rem">
            <a href="{{ route('psicologos.index') }}" class="btn btn-primary btn-lg">Ver Todos os Psicólogos</a>
        </div>
    </div>
</div>
@endif

{{-- SOBRE ─────────────────────────────────────────────────────────────── --}}
<div class="section">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center">
        <div>
            <h2 style="font-family:var(--fonte-titulo); font-size:2rem; color:var(--roxo-escuro); margin-bottom:1.5rem">Sobre a Lumi</h2>
            <p style="margin-bottom:1rem; color:var(--cinza-600)">A Lumi nasceu da necessidade de criar um espaço acessível e acolhedor para o cuidado da saúde mental. Nossa plataforma oferece ferramentas de autoajuda baseadas em evidências científicas.</p>
            <p style="margin-bottom:1rem; color:var(--cinza-600)">Acreditamos que o bem-estar emocional deve ser uma prioridade acessível a todos. Por isso, desenvolvemos recursos para o seu dia a dia, enquanto facilitamos o contato com psicólogos.</p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-primary">Criar conta gratuita</a>
            @endguest
        </div>
        <img src="{{ asset('img/cerebro.jpg') }}" alt="" style="height: 350px;">

    </div>
</div>
@endsection