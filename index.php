<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BarberPro SaaS</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee&family=Permanent+Marker&display=swap" rel="stylesheet">

<style>

.bungee-regular {
  font-family: "Bungee", sans-serif;
  font-weight: 400;
  font-style: normal;
}

/* =====================================================
   FOOTER SIMPLES
===================================================== */

.footer {
    width: 100%;
    background: #ffffff;
    color: #fff;
    padding: 18px 1px;
    margin-top: 40px;
    text-align: center;
}

.footer-logo {
    color: #000000;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 4px;
}

.footer p {
    margin: 0;
    color: #f60606;
    font-size: 11px;
}

.footer-bottom {
    margin-top: 1px;
    padding-top: 1px;
    border-top: 1px solid rgba(0, 0, 0, .25);
    color: #000;
    font-size: 15px;
}

.imagem-topo {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0px;
}

.imagem-topo img {
    display: block;
    width: 100%;
    max-width: 1800px;
    height: 300px;
    object-fit: fill;
}

@media (max-width: 720px) {
    .imagem-topo img {
        height: 300px;
    }
}

/* =====================================================
   RESET
===================================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    background: #000;
    color: #fff;
    min-height: 100vh;
    padding-top: 70px;
}


/* =====================================================
   CORES
===================================================== */

:root {
    --vermelho: #ff1a1a;
    --vermelho-escuro: #b30000;
    --cinza: #a1a1aa;
    --preto-card: #090909;
    --borda: #292929;
}


/* =====================================================
   TOPO
===================================================== */

.topbar {
    width: 100%;
    height: 70px;

    background: #fff;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 30px;

    position: fixed;
    top: 0;
    left: 0;

    z-index: 2000;

    border-bottom: 1px solid #e5e5e5;

    box-shadow:
        0 4px 20px rgba(0,0,0,.15);
}

.left-area {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo {
font-family: "Permanent Marker", cursive;
    font-weight: 600;
    font-size: 25px;
    color: #fa0707;
}

.menu-icon {
    font-size: 26px;
    cursor: pointer;

    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    user-select: none;

    color: #000;

    transition: .2s;
}

.menu-icon:hover {
    color: var(--vermelho);

    text-shadow:
        0 0 8px var(--vermelho),
        0 0 18px var(--vermelho);
}


/* =====================================================
   CONSULTA
===================================================== */

.consulta-area {
    display: flex;
    align-items: center;
    gap: 10px;
}

.consulta-area input {
    width: 190px;

    padding: 10px 12px;

    border-radius: 7px;
    border: 1px solid #333;

    outline: none;

    background: #111;
    color: #fff;

    font-size: 14px;
}

.consulta-area button,
.mobile-consulta-panel button {
    background:
        linear-gradient(
            45deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    border: 1px solid var(--vermelho);

    padding: 10px 17px;

    border-radius: 7px;

    color: #fff;

    cursor: pointer;

    font-weight: 500;

    transition: .25s;
}

.consulta-area button:hover,
.mobile-consulta-panel button:hover {
    transform: translateY(-1px);

    box-shadow:
        0 0 10px var(--vermelho),
        0 0 25px rgba(255,0,0,.45);
}


/* =====================================================
   CONSULTA MOBILE
===================================================== */

.mobile-consulta-button {
    display: none;

    width: 42px;
    height: 42px;

    border-radius: 50%;

    background: #111;
    border: 1px solid #333;

    align-items: center;
    justify-content: center;

    cursor: pointer;
}

.mobile-consulta-panel {
    display: none;

    position: absolute;

    top: 65px;
    right: 15px;

    width: calc(100% - 30px);
    max-width: 320px;

    background: #080808;

    padding: 20px;

    border-radius: 10px;

    border: 1px solid #292929;

    box-shadow:
        0 10px 35px rgba(0,0,0,.7);

    z-index: 2100;
}

.mobile-consulta-panel.aberto {
    display: block;
}

.mobile-consulta-panel h3 {
    margin-bottom: 15px;
}

.mobile-consulta-panel input {
    width: 100%;

    padding: 11px;

    margin-bottom: 10px;

    border-radius: 6px;

    border: 1px solid #333;

    outline: none;

    background: #111;

    color: #fff;
}

.mobile-consulta-panel button {
    width: 100%;
}


/* =====================================================
   SIDEBAR
===================================================== */

.sidebar {
    position: fixed;

    top: 70px;
    left: 0;

    width: 280px;

    height: calc(100vh - 70px);

    background: #fff;

    display: flex;
    flex-direction: column;

    transform: translateX(-100%);

    transition: transform .3s ease;

    z-index: 1900;

    box-shadow:
        5px 0 30px rgba(0,0,0,.7);

    overflow-y: auto;

    pointer-events: none;
}

.sidebar.aberta {
    transform: translateX(0);
    pointer-events: auto;
}

.sidebar a,
.sidebar button {
    display: block;

    width: 100%;

    padding: 17px 20px;

    text-decoration: none;

    color: #111;

    font-weight: 500;

    border: 0;
    border-bottom: 1px solid #e5e5e5;

    background: #fff;

    text-align: left;

    cursor: pointer;

    transition: .2s;
}

.sidebar a:hover,
.sidebar button:hover {
    background: #111;

    color: var(--vermelho);

    padding-left: 25px;
}

.sidebar .sidebar-login {
    margin-top: auto;
    border-top: 1px solid #e5e5e5;
}


/* =====================================================
   HERO
===================================================== */

.hero {
    text-align: center;

    padding: 70px 20px 30px;
}

.hero h1 {
    font-family: "Bungee", sans-serif;

    font-size: 40px;
    text-align: center;
    color: #ff1a1a;
    font-size: 30px;
    font-weight: 600;
    letter-spacing: 2px;

    animation: pulsarSimples 2s ease-in-out infinite;
}

@keyframes pulsarSimples {
    0%, 100% {
        opacity: 0.8;
        transform: scale(1);
    }

    50% {
        opacity: 1;
        transform: scale(1.03);
    }
}

.hero p {
    margin-top: 20px;

    color: var(--cinza);
}


/* =====================================================
   BOTÃO INICIAL
===================================================== */

.inicio-agendamento {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    padding: 25px 20px 40px;

    box-sizing: border-box;
}


/* =====================================================
   BOTÃO AGENDAR
===================================================== */

.botao-agendar {
    font-family: "Permanent Marker", cursive;
    display: block;

    width: auto;

    margin-left: auto;
    margin-right: auto;

    background:
        linear-gradient(
            45deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    border: 1px solid var(--vermelho);

    padding: 15px 45px;

    border-radius: 0px;

    color: #fff;

    font-size: 25px;

    font-weight: 600;

    cursor: pointer;

    box-shadow: none;

    /*
     * Movimento contínuo
     */
    
        animation: pulsarSimples 2s ease-in-out infinite;
}


/* =====================================================
   HOVER
===================================================== */

.botao-agendar:hover {

    background: var(--vermelho);

    box-shadow: none;

    animation-play-state: paused;

}


/* =====================================================
   MOVIMENTO ESQUERDA ↔ DIREITA
===================================================== */

@keyframes moverAgendar {

    0% {
        transform: translateX(-8px);
    }

    50% {
        transform: translateX(8px);
    }

    100% {
        transform: translateX(-8px);
    }

}

/* =====================================================
   PAINEL DE SERVIÇOS
===================================================== */

.painel-servicos {
    width: 100%;
    max-width: 1100px;

    margin: 0 auto 60px;

    padding: 30px;

    display: none;
}

.painel-servicos.visivel {
    display: block;

    animation: aparecer .4s ease;
}

.painel-header {
    text-align: center;

    margin-bottom: 30px;
}

.painel-header h2 {
    font-size: 28px;
    font-weight: 500;
}

.painel-header p {
    color: var(--cinza);
    margin-top: 8px;
}


/* =====================================================
   FORMULÁRIO SERVIÇO
===================================================== */

.cadastro-servico {
    background: #080808;

    border: 1px solid var(--borda);

    border-radius: 15px;

    padding: 25px;

    margin-bottom: 30px;
}

.cadastro-servico h3 {
    margin-bottom: 20px;
    font-weight: 500;
}

.form-servico {
    display: grid;

    grid-template-columns: 2fr 1fr 1fr auto;

    gap: 12px;

    align-items: end;
}

.campo-form label {
    display: block;

    margin-bottom: 7px;

    font-size: 13px;

    color: #ccc;
}

.campo-form input {
    width: 100%;

    padding: 12px;

    background: #111;

    border: 1px solid #333;

    border-radius: 7px;

    color: #fff;

    outline: none;
}

.campo-form input:focus {
    border-color: var(--vermelho);

    box-shadow:
        0 0 8px rgba(255,0,0,.3);
}

.botao-salvar-servico {
    padding: 12px 20px;

    border-radius: 7px;

    border: 1px solid var(--vermelho);

    background:
        linear-gradient(
            45deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    color: #fff;

    cursor: pointer;

    font-weight: 500;
}


/* =====================================================
   LISTA DE SERVIÇOS
===================================================== */

.lista-servicos {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 15px;
}

.servico-admin {
    background: var(--preto-card);

    border: 1px solid var(--borda);

    border-radius: 12px;

    padding: 20px;

    transition: .2s;
}

.servico-admin:hover {
    border-color: var(--vermelho);

    transform: translateY(-2px);
}

.servico-admin h4 {
    font-size: 18px;

    margin-bottom: 8px;
}

.servico-admin-preco {
    color: var(--vermelho);

    font-size: 20px;

    font-weight: 600;

    margin-bottom: 5px;
}

.servico-admin-duracao {
    color: var(--cinza);

    font-size: 13px;

    margin-bottom: 18px;
}

.acoes-servico {
    display: flex;

    gap: 8px;
}

.acoes-servico button {
    flex: 1;

    padding: 9px;

    border-radius: 6px;

    cursor: pointer;

    border: 1px solid #333;

    background: #151515;

    color: #fff;
}

.acoes-servico .editar:hover {
    border-color: #fff;
}

.acoes-servico .excluir:hover {
    border-color: var(--vermelho);

    color: var(--vermelho);
}


/* =====================================================
   AGENDAMENTO
===================================================== */

.agendamento {
    width: 100%;

    max-width: 1100px;

    margin: 0 auto;

    padding: 30px 30px 80px;

    display: none;
}

.agendamento.visivel {
    display: block;

    animation: aparecer .4s ease;
}


/* =====================================================
   ETAPAS
===================================================== */

.etapa {
    display: none;

    animation: aparecer .4s ease;
}

.etapa.ativa {
    display: block;
}


/* =====================================================
   PROGRESSO - 5 ETAPAS
===================================================== */

.progresso-agendamento {
    display: flex;

    justify-content: center;

    align-items: center;

    gap: 8px;

    margin-bottom: 35px;
}

.progresso-item {
    width: 32px;
    height: 32px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #181818;

    border: 1px solid #333;

    color: #777;

    font-size: 13px;

    transition: .3s;
}

.progresso-item.ativo {
    background: var(--vermelho);

    border-color: var(--vermelho);

    color: #fff;

    box-shadow:
        0 0 10px rgba(255,0,0,.5);
}

.progresso-linha {
    width: 35px;

    height: 1px;

    background: #333;
}


/* =====================================================
   CABEÇALHO
===================================================== */

.agendamento-header {
    text-align: center;

    margin-bottom: 35px;
}

.agendamento-header h2 {
    font-size: 30px;

    font-weight: 500;
    color: #b22626;
    font-family: "Bungee", sans-serif;
}

.agendamento-header p {
    color: var(--cinza);

    font-size: 14px;

    margin-top: 8px;
}


/* =====================================================
   DADOS CLIENTE
===================================================== */

.dados-cliente {
    width: 100%;

    max-width: 500px;

    margin: 0 auto;
    
}

.campo-cliente {
    width: 100%;

    margin-bottom: 18px;
}

.campo-cliente label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;

    font-weight: 500;
    font-family: "Bungee", sans-serif;
}

.campo-cliente input {
    width: 100%;

    padding: 14px 15px;

    border-radius: 8px;

    border: 1px solid #333;

    outline: none;

    background: #101010;

    color: #b22626;

    font-size: 15px;
}

.campo-cliente input.erro {
    border-color: var(--vermelho);
}


/* =====================================================
   SERVIÇOS DO AGENDAMENTO
===================================================== */

.servicos-container {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 15px;
    
}

.servico-card {
    background: var(--preto-card);

    border: 1px solid var(--borda);

    border-radius: 13px;

    padding: 22px;

    cursor: pointer;

    transition: .25s;
}

.servico-card:hover {
    border-color: var(--vermelho);

    transform: translateY(-3px);

    box-shadow:
        0 0 12px rgba(255,0,0,.25);
}

.servico-card.selecionado {
    border-color: var(--vermelho);

    background:
        linear-gradient(
            135deg,
            #250000,
            #100000
        );

    box-shadow:
        0 0 12px var(--vermelho),
        0 0 30px rgba(255,0,0,.25);
}

.servico-card h3 {
    font-size: 18px;

    margin-bottom: 10px;
}

.servico-preco {
    font-size: 22px;

    font-weight: 600;

    color: var(--vermelho);

    margin-bottom: 7px;
}

.servico-duracao {
    color: var(--cinza);

    font-size: 13px;
}


/* =====================================================
   PROFISSIONAIS
===================================================== */

.profissionais-container {
    display: flex;

    justify-content: center;

    align-items: flex-start;

    gap: 50px;
}

.profissional {
    display: flex;

    flex-direction: column;

    align-items: center;

    cursor: pointer;

    width: 150px;
}

.profissional-foto {
    width: 120px;
    height: 120px;

    border-radius: 50%;

    object-fit: cover;

    border: 4px solid transparent;

    transition: .25s;
}

.profissional:hover .profissional-foto,
.profissional.selecionado .profissional-foto {
    border-color: var(--vermelho);

    transform: scale(1.05);

    box-shadow:
        0 0 10px var(--vermelho),
        0 0 25px rgba(255,0,0,.35);
}

.profissional-nome {
    margin-top: 12px;

    font-size: 16px;

    font-weight: 500;

    text-align: center;
}


/* =====================================================
   DATAS
===================================================== */

.datas-container {
    display: grid;

    grid-template-columns:
        repeat(5, 1fr);

    gap: 15px;

    width: 100%;
}

.data-card {
    background: var(--preto-card);

    border: 1px solid var(--borda);

    border-radius: 12px;

    padding: 22px 15px;

    text-align: center;

    cursor: pointer;

    transition: .2s;
}

.data-card:hover,
.data-card.selecionada {
    border-color: var(--vermelho);

    transform: translateY(-3px);
}

.data-card.selecionada {
    background:
        linear-gradient(
            135deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    box-shadow:
        0 0 12px var(--vermelho);
}

.data-semana {
    display: block;

    font-size: 13px;

    color: #888;

    text-transform: uppercase;

    margin-bottom: 8px;
}

.data-card.selecionada .data-semana,
.data-card.selecionada .data-mes {
    color: #fff;
}

.data-numero {
    display: block;

    font-size: 30px;

    font-weight: 600;
}

.data-mes {
    display: block;

    font-size: 13px;

    color: #888;

    margin-top: 4px;
}


/* =====================================================
   HORÁRIOS
===================================================== */

.horarios-section {
    padding: 30px;

    background: #080808;

    border-radius: 15px;

    border: 1px solid var(--borda);
}

.horarios-header {
    text-align: center;

    margin-bottom: 25px;
}

.horarios-header h2 {
    font-size: 22px;

    font-weight: 500;
}

.horarios-header p {
    margin-top: 6px;

    color: var(--vermelho);
}

.horarios-container {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 12px;
}

.horario {
    padding: 14px;

    background: #101010;

    border: 1px solid #333;

    border-radius: 8px;

    color: #fff;

    text-align: center;

    cursor: pointer;

    transition: .2s;
}

.horario:hover,
.horario.selecionado {
    background: var(--vermelho);

    border-color: var(--vermelho);

    transform: translateY(-2px);
}


/* =====================================================
   BOTÕES
===================================================== */

.navegacao-etapa {
    display: flex;

    justify-content: center;

    align-items: center;

    gap: 12px;

    margin-top: 35px;
}

.botao-proximo,
.botao-voltar {
    padding: 12px 30px;

    border-radius: 7px;

    cursor: pointer;

    font-size: 15px;

    font-weight: 500;

    transition: .25s;
}

.botao-proximo {
    background:
        linear-gradient(
            45deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    border: 1px solid var(--vermelho);

    color: #fff;
}

.botao-proximo:disabled {
    opacity: .4;

    cursor: not-allowed;

    box-shadow: none;
}

.botao-voltar {
    background: #151515;

    border: 1px solid #333;

    color: #fff;
}

.botao-voltar:hover {
    border-color: #666;
    background: #222;
}


/* =====================================================
   RESUMO
===================================================== */

.resumo-agendamento {
    margin-top: 30px;

    padding: 25px;

    border-radius: 10px;

    border: 1px solid var(--borda);

    background: #090909;

    text-align: center;
}

.resumo-agendamento p {
    color: var(--cinza);

    margin-bottom: 8px;
}

.resumo-agendamento strong {
    color: #fff;
}

.resumo-preco {
    font-size: 20px;

    color: var(--vermelho) !important;
}


/* =====================================================
   ANIMAÇÃO
===================================================== */

@keyframes aparecer {

    from {
        opacity: 0;
        transform: translateY(15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 900px) {

    .consulta-area input {
        width: 160px;
    }

    .datas-container {
        grid-template-columns:
            repeat(3, 1fr);
    }

    .horarios-container {
        grid-template-columns:
            repeat(3, 1fr);
    }

    .lista-servicos,
    .servicos-container {
        grid-template-columns:
            repeat(2, 1fr);
    }

    .form-servico {
        grid-template-columns:
            1fr 1fr;
    }

}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 768px) {

    .topbar {
        padding: 0 15px;
    }

    .consulta-area {
        display: none;
    }

    .mobile-consulta-button {
        display: flex;
    }

    .logo {
        font-size: 18px;
    }

    .sidebar {
        width: 80%;
        max-width: 280px;
    }

    .hero {
        padding: 55px 20px 25px;
    }

    .hero h1 {
        font-size: 30px;
    }

    .agendamento,
    .painel-servicos {
        padding: 25px 15px 60px;
    }

    .progresso-agendamento {
        gap: 4px;
    }

    .progresso-linha {
        width: 12px;
    }

    .progresso-item {
        width: 28px;
        height: 28px;
        font-size: 11px;
    }

    .profissionais-container {
        gap: 15px;
    }

    .profissional {
        width: 100px;
    }

    .profissional-foto {
        width: 90px;
        height: 90px;
    }

    .profissional-nome {
        font-size: 14px;
    }

    .datas-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .data-card {
        width: 100%;

        padding: 18px 15px;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 15px;
    }

    .data-semana {
        margin-bottom: 0;
    }

    .data-numero {
        font-size: 26px;
    }

    .horarios-section {
        padding: 20px 15px;
    }

    .horarios-container {
        grid-template-columns:
            repeat(2, 1fr);
    }

    .dados-cliente {
        max-width: 100%;
    }

    .lista-servicos,
    .servicos-container {
        grid-template-columns: 1fr;
    }

    .form-servico {
        grid-template-columns: 1fr;
    }

}


/* =====================================================
   CELULARES PEQUENOS
===================================================== */

@media (max-width: 400px) {

    .logo {
        font-size: 16px;
    }

    .hero h1 {
        font-size: 26px;
    }

    .profissional {
        width: 90px;
    }

    .profissional-foto {
        width: 75px;
        height: 75px;
    }

    .profissional-nome {
        font-size: 13px;
    }

    .botao-proximo,
    .botao-voltar {
        padding: 11px 22px;
    }

}
/* =====================================================
   MODAL DE CONFIRMAÇÃO DO AGENDAMENTO
===================================================== */

.modal-confirmacao {
    position: fixed;

    inset: 0;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 20px;

    background: rgba(0, 0, 0, .82);

    backdrop-filter: blur(5px);

    z-index: 5000;
}

.modal-confirmacao.aberto {
    display: flex;

    animation: aparecer .25s ease;
}

.modal-caixa {
    width: 100%;
    max-width: 520px;

    max-height: 90vh;

    overflow-y: auto;

    background: #090909;

    border: 1px solid #333;

    border-radius: 18px;

    padding: 30px;

    box-shadow:
        0 20px 70px rgba(0, 0, 0, .8),
        0 0 30px rgba(255, 0, 0, .15);
}

.modal-cabecalho {
    text-align: center;

    margin-bottom: 25px;
}

.modal-icone {
    width: 55px;
    height: 55px;

    margin: 0 auto 15px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(255, 26, 26, .12);

    border: 1px solid var(--vermelho);

    color: var(--vermelho);

    font-size: 25px;
}

.modal-cabecalho h2 {
    font-size: 24px;

    font-weight: 600;
}

.modal-cabecalho p {
    margin-top: 7px;

    color: var(--cinza);

    font-size: 14px;
}

.modal-detalhes {
    border: 1px solid var(--borda);

    border-radius: 12px;

    overflow: hidden;

    margin-bottom: 25px;
}

.modal-detalhe {
    display: flex;

    justify-content: space-between;

    gap: 20px;

    padding: 13px 16px;

    border-bottom: 1px solid #1d1d1d;
}

.modal-detalhe:last-child {
    border-bottom: 0;
}

.modal-detalhe span {
    color: var(--cinza);

    font-size: 13px;
}

.modal-detalhe strong {
    color: #fff;

    font-size: 14px;

    text-align: right;
}

.modal-detalhe.preco strong {
    color: var(--vermelho);

    font-size: 18px;
}

.modal-acoes {
    display: flex;

    gap: 10px;
}

.modal-acoes button {
    flex: 1;

    padding: 13px 18px;

    border-radius: 8px;

    cursor: pointer;

    font-size: 14px;

    font-weight: 500;

    transition: .25s;
}

.modal-botao-editar {
    background: #151515;

    border: 1px solid #333;

    color: #fff;
}

.modal-botao-editar:hover {
    background: #222;

    border-color: #555;
}

.modal-botao-confirmar {
    background:
        linear-gradient(
            45deg,
            var(--vermelho-escuro),
            var(--vermelho)
        );

    border: 1px solid var(--vermelho);

    color: #fff;
}

.modal-botao-confirmar:hover {
    transform: translateY(-2px);

    box-shadow:
        0 0 12px var(--vermelho),
        0 0 25px rgba(255, 0, 0, .35);
}


/* =====================================================
   SUCESSO
===================================================== */

.modal-sucesso {
    text-align: center;

    display: none;
}

.modal-sucesso.visivel {
    display: block;

    animation: aparecer .3s ease;
}

.modal-sucesso-icone {
    width: 65px;
    height: 65px;

    margin: 0 auto 18px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #151515;

    border: 2px solid var(--vermelho);

    color: var(--vermelho);

    font-size: 30px;
}

.modal-sucesso h2 {
    margin-bottom: 10px;
}

.modal-sucesso p {
    color: var(--cinza);

    font-size: 14px;

    line-height: 1.6;
}

.modal-botao-fechar {
    width: 100%;

    margin-top: 25px;

    padding: 13px;

    border-radius: 8px;

    border: 1px solid var(--vermelho);

    background: var(--vermelho);

    color: #fff;

    cursor: pointer;

    font-weight: 600;
}


/* =====================================================
   MODAL MOBILE
===================================================== */

@media (max-width: 500px) {

    .modal-caixa {
        padding: 22px;

        border-radius: 15px;
    }

    .modal-cabecalho h2 {
        font-size: 21px;
    }

    .modal-detalhe {
        flex-direction: column;

        gap: 3px;
    }

    .modal-detalhe strong {
        text-align: left;
    }

    .modal-acoes {
        flex-direction: column;
    }

}
</style>


</head>


<body>


<!-- =====================================================
     TOPO
===================================================== -->

<div class="topbar">

    <div class="left-area">

        <div
            class="menu-icon"
            onclick="toggleMenu()"
        >
            ☰
        </div>

        <div class="logo">
            AgendaLogo.com.br
        </div>

    </div>


    <form
        class="consulta-area"
        onsubmit="consultarAgendamento(event)"
    >

        <input
            type="tel"
            placeholder="(XX) XXXXX-XXXX"
            maxlength="15"
            required
        >

        <button type="submit">
            Consultar Agendamento
        </button>

    </form>


    <div
        class="mobile-consulta-button"
        onclick="toggleConsultaMobile()"
    >
        📅
    </div>


    <div
        class="mobile-consulta-panel"
        id="mobileConsultaPanel"
    >

        <h3>
            Consultar Agendamento
        </h3>

        <form
            onsubmit="consultarAgendamento(event)"
        >

            <input
                type="tel"
                class="telefone-input"
                placeholder="(XX) XXXXX-XXXX"
                maxlength="15"
                required
            >

            <button type="submit">
                Consultar Agendamento
            </button>

        </form>

    </div>

</div>

<div class="imagem-topo">
    <img
        src="img/logotipo.png"
        alt="Imagem principal"
    >
</div>
<!-- =====================================================
     SIDEBAR
===================================================== -->

<div
    class="sidebar"
    id="sidebar"
>

   <!-- <button onclick="abrirPainelServicos()">
        💈 Serviços e Preços
    </button> -->

    <a href="index.php">
        Inicio
    </a>

    <a href="#">
        Planos Mensais
    </a>

    <a href="#">
        Quem somos?
    </a>

    <a href="#">
        Endereço
    </a>

    <a class="sidebar-login" href="login.php" target="_blank">
        Login
    </a>

</div>


<!-- =====================================================
     HERO
===================================================== -->

<div class="hero" id="hero">

    <h1>
        Agende agora mesmo!
    </h1>

    <p>
        Agende de forma rapida nossos serviços<br>
        Barbearia
    </p>

</div>


<!-- =====================================================
     PAINEL DE SERVIÇOS
===================================================== -->

<section
    class="painel-servicos"
    id="painelServicos"
>

    <div class="painel-header">

        <h2>
            Serviços e Preços
        </h2>

        <p>
            Cadastre os serviços oferecidos pela sua barbearia.
        </p>

    </div>


    <div class="cadastro-servico">

        <h3 id="tituloFormularioServico">
            Cadastrar novo serviço
        </h3>

        <form
            class="form-servico"
            onsubmit="salvarServico(event)"
        >

            <div class="campo-form">

                <label>
                    Nome do serviço
                </label>

                <input
                    type="text"
                    id="nomeServico"
                    placeholder="Ex: Corte Masculino"
                    maxlength="80"
                    required
                >

            </div>


            <div class="campo-form">

                <label>
                    Preço
                </label>

                <input
                    type="number"
                    id="precoServico"
                    placeholder="0,00"
                    min="0"
                    step="0.01"
                    required
                >

            </div>


            <div class="campo-form">

                <label>
                    Duração (minutos)
                </label>

                <input
                    type="number"
                    id="duracaoServico"
                    placeholder="30"
                    min="5"
                    step="5"
                    required
                >

            </div>


            <button
                type="submit"
                class="botao-salvar-servico"
                id="botaoSalvarServico"
            >
                Cadastrar
            </button>

        </form>

    </div>


    <div
        class="lista-servicos"
        id="listaServicos"
    >
    </div>

</section>


<!-- =====================================================
     BOTÃO INICIAL
===================================================== -->

<div
    class="inicio-agendamento"
    id="inicioAgendamento"
>

    <button
        class="botao-agendar"
        onclick="iniciarAgendamento()"
    >
        Agendar
    </button>

</div>


<!-- =====================================================
     AGENDAMENTO
===================================================== -->

<section
    class="agendamento"
    id="agendamento"
>


    <!-- PROGRESSO -->

    <div class="progresso-agendamento">

        <div class="progresso-item ativo" id="progresso1">
            1
        </div>

        <div class="progresso-linha"></div>

        <div class="progresso-item" id="progresso2">
            2
        </div>

        <div class="progresso-linha"></div>

        <div class="progresso-item" id="progresso3">
            3
        </div>

        <div class="progresso-linha"></div>

        <div class="progresso-item" id="progresso4">
            4
        </div>

        <div class="progresso-linha"></div>

        <div class="progresso-item" id="progresso5">
            5
        </div>

    </div>


    <!-- =================================================
         ETAPA 1 - CLIENTE
    ================================================== -->

    <div
        class="etapa ativa"
        id="etapa1"
    >

        <div class="agendamento-header">

            <h2>
                Seus dados
            </h2>

            <p>
                Informe seus dados para iniciar o agendamento.
            </p>

        </div>


        <div class="dados-cliente">

            <div class="campo-cliente">

                <label for="nomeCliente">
                    Seu Nome
                </label>

                <input
                    type="text"
                    id="nomeCliente"
                    placeholder="Digite seu nome"
                    autocomplete="name"
                    maxlength="100"
                >

            </div>


            <div class="campo-cliente">

                <label for="telefoneCliente">
                    Telefone
                </label>

                <input
                    type="tel"
                    id="telefoneCliente"
                    placeholder="(xx) xxxxx-xxxx"
                    maxlength="15"
                    autocomplete="tel"
                >

            </div>

        </div>


        <div class="navegacao-etapa">

            <button
                class="botao-proximo"
                onclick="proximaEtapa(2)"
            >
                Próximo
            </button>

        </div>

    </div>



    <!-- =================================================
         ETAPA 2 - SERVIÇO
    ================================================== -->

    <div
        class="etapa"
        id="etapa2"
    >

        <div class="agendamento-header">

            <h2>
                Escolha o serviço
            </h2>

            <p>
                Selecione o serviço que deseja realizar.
            </p>

        </div>


        <div
            class="servicos-container"
            id="servicosContainer"
        >
        </div>


        <div class="navegacao-etapa">

            <button
                class="botao-voltar"
                onclick="voltarEtapa(1)"
            >
                Voltar
            </button>

            <button
                class="botao-proximo"
                id="botaoProximoServico"
                onclick="proximaEtapa(3)"
                disabled
            >
                Próximo
            </button>

        </div>

    </div>


    <!-- =================================================
         ETAPA 3 - PROFISSIONAL
    ================================================== -->

    <div
        class="etapa"
        id="etapa3"
    >

        <div class="agendamento-header">

            <h2>
                Escolha seu profissional
            </h2>

            <p>
                Selecione o profissional de sua preferência.
            </p>

        </div>


        <div
    class="profissionais-container"
    id="profissionaisContainer"
>
</div>


        <div class="navegacao-etapa">

            <button
                class="botao-voltar"
                onclick="voltarEtapa(2)"
            >
                Voltar
            </button>

            <button
                class="botao-proximo"
                id="botaoProximoProfissional"
                onclick="proximaEtapa(4)"
                disabled
            >
                Próximo
            </button>

        </div>

    </div>


    <!-- =================================================
         ETAPA 4 - DATA
    ================================================== -->

    <div
        class="etapa"
        id="etapa4"
    >

        <div class="agendamento-header">

            <h2>
                Escolha a data
            </h2>

            <p>
                Selecione o dia em que deseja realizar seu atendimento.
            </p>

        </div>


        <div
            class="datas-container"
            id="datasContainer"
        >
        </div>


        <div class="navegacao-etapa">

            <button
                class="botao-voltar"
                onclick="voltarEtapa(3)"
            >
                Voltar
            </button>

            <button
                class="botao-proximo"
                id="botaoProximoData"
                onclick="proximaEtapa(5)"
                disabled
            >
                Próximo
            </button>

        </div>

    </div>


    <!-- =================================================
         ETAPA 5 - HORÁRIO
    ================================================== -->

    <div
        class="etapa"
        id="etapa5"
    >

        <div class="agendamento-header">

            <h2>
                Escolha o horário
            </h2>

            <p>
                Selecione um dos horários disponíveis.
            </p>

        </div>


        <div class="horarios-section">

            <div class="horarios-header">

                <h2>
                    Horários disponíveis
                </h2>

                <p id="dataSelecionada">
                    Selecione uma data
                </p>

            </div>


            <div
                class="horarios-container"
                id="horariosContainer"
            >
            </div>

        </div>


        <div class="navegacao-etapa">

            <button
                class="botao-voltar"
                onclick="voltarEtapa(4)"
            >
                Voltar
            </button>

            <button
                class="botao-proximo"
                id="botaoFinalizar"
                onclick="finalizarAgendamento()"
                disabled
            >
                Agendar Horário
            </button>

        </div>


        <!-- RESUMO -->

        <div
            class="resumo-agendamento"
            id="resumoAgendamento"
            style="display:none;"
        >

            <p>
                Nome:
                <strong id="resumoNome"></strong>
            </p>

            <p>
                Telefone:
                <strong id="resumoTelefone"></strong>
            </p>

            <p>
                Serviço:
                <strong id="resumoServico"></strong>
            </p>

            <p>
                Duração:
                <strong id="resumoDuracao"></strong>
            </p>

            <p>
                Preço:
                <strong
                    id="resumoPreco"
                    class="resumo-preco"
                ></strong>
            </p>

            <p>
                Profissional:
                <strong id="resumoProfissional"></strong>
            </p>

            <p>
                Data:
                <strong id="resumoData"></strong>
            </p>

            <p>
                Horário:
                <strong id="resumoHorario"></strong>
            </p>

        </div>

    </div>

</section>

<!-- =====================================================
     MODAL DE CONFIRMAÇÃO
===================================================== -->

<div
    class="modal-confirmacao"
    id="modalConfirmacao"
>

    <div class="modal-caixa">

        <div id="conteudoConfirmacao">

            <div class="modal-cabecalho">

                <div class="modal-icone">
                    ✓
                </div>

                <h2>
                    Confirmar agendamento
                </h2>

                <p>
                    Confira os dados antes de confirmar.
                </p>

            </div>


            <div class="modal-detalhes">

                <div class="modal-detalhe">
                    <span>Nome</span>
                    <strong id="modalNome"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Telefone</span>
                    <strong id="modalTelefone"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Serviço</span>
                    <strong id="modalServico"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Duração</span>
                    <strong id="modalDuracao"></strong>
                </div>

                <div class="modal-detalhe preco">
                    <span>Preço</span>
                    <strong id="modalPreco"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Profissional</span>
                    <strong id="modalProfissional"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Data</span>
                    <strong id="modalData"></strong>
                </div>

                <div class="modal-detalhe">
                    <span>Horário</span>
                    <strong id="modalHorario"></strong>
                </div>

            </div>


            <div class="modal-acoes">

                <button
                    type="button"
                    class="modal-botao-editar"
                    onclick="fecharModalConfirmacao()"
                >
                    Voltar / Editar
                </button>

                <button
                    type="button"
                    class="modal-botao-confirmar"
                    onclick="confirmarAgendamento()"
                >
                    Confirmar agendamento
                </button>

            </div>

        </div>


        <!-- SUCESSO -->

        <div
            class="modal-sucesso"
            id="modalSucesso"
        >

            <div class="modal-sucesso-icone">
                ✓
            </div>

            <h2>
                Agendamento confirmado!
            </h2>

            <p>
                Seu horário foi reservado com sucesso.
                <br>
                Agradecemos pela preferência!
            </p>

            <button
                type="button"
                class="modal-botao-fechar"
                onclick="fecharModalFinal()"
            >
                Concluir
            </button>

        </div>

    </div>

</div>
<script>

/* =====================================================
   SERVIÇOS DO BANCO DE DADOS
===================================================== */

let servicos = [];


/* =====================================================
   FORMATAR PREÇO
===================================================== */

function formatarPreco(valor) {

    return Number(valor).toLocaleString(
        "pt-BR",
        {
            style: "currency",
            currency: "BRL"
        }
    );

}


/* =====================================================
   CARREGAR SERVIÇOS CADASTRADOS
   Os serviços vêm exclusivamente da tabela "servicos".
   Não existe mais lista fixa nem localStorage.
===================================================== */

async function carregarServicosDoBanco() {

    const container =
        document.getElementById("servicosContainer");

    if (container) {

        container.innerHTML = `
            <div class="servico-card">
                <h3>Carregando serviços...</h3>
                <p class="servico-duracao">
                    Aguarde um momento.
                </p>
            </div>
        `;

    }

    try {

        const resposta =
            await fetch(
                "gerenciar_servico.php?acao=listar",
                {
                    method: "GET",
                    cache: "no-store",
                    headers: {
                        "Accept": "application/json"
                    }
                }
            );


        const texto =
            await resposta.text();

        let dados;

        try {

            dados = JSON.parse(texto);

        } catch (erro) {

            throw new Error(
                "O servidor não retornou uma resposta válida."
            );

        }


        if (!resposta.ok || !dados.sucesso) {

            throw new Error(
                dados.mensagem ||
                "Não foi possível carregar os serviços."
            );

        }


        servicos =
            Array.isArray(dados.servicos)
                ? dados.servicos.map(function(servico) {

                    return {
                        id: Number(servico.id),
                        nome: String(servico.nome),
                        preco: Number(servico.preco),
                        duracao: Number(servico.duracao)
                    };

                })
                : [];


        renderizarServicosAgendamento();


    } catch (erro) {

        console.error(
            "Erro ao carregar serviços:",
            erro
        );


        servicos = [];


        if (container) {

            container.innerHTML = `
                <div class="servico-card">
                    <h3>Não foi possível carregar os serviços</h3>
                    <p class="servico-duracao">
                        Tente novamente em alguns instantes.
                    </p>
                </div>
            `;

        }

    }

}


/* =====================================================
   MENU
===================================================== */

function toggleMenu() {

    document
        .getElementById("sidebar")
        .classList.toggle("aberta");

}


/* =====================================================
   ABRIR PAINEL SERVIÇOS
===================================================== */

function abrirPainelServicos() {

    const painel =
        document.getElementById(
            "painelServicos"
        );

    const agendamento =
        document.getElementById(
            "agendamento"
        );

    const inicio =
        document.getElementById(
            "inicioAgendamento"
        );


    agendamento.classList.remove(
        "visivel"
    );

    inicio.style.display = "none";

    painel.classList.add(
        "visivel"
    );


    document
        .getElementById("sidebar")
        .classList.remove("aberta");


    renderizarServicosAdmin();


    painel.scrollIntoView({
        behavior: "smooth",
        block: "start"
    });

}


/* =====================================================
   RENDERIZAR SERVIÇOS ADMIN
===================================================== */

function renderizarServicosAdmin() {

    const lista =
        document.getElementById(
            "listaServicos"
        );


    if (!lista) {
        return;
    }


    lista.innerHTML = "";


    if (servicos.length === 0) {

        lista.innerHTML = `
            <div class="servico-admin">
                <h4>Nenhum serviço cadastrado</h4>
                <p class="servico-admin-duracao">
                    Cadastre seu primeiro serviço no painel administrativo.
                </p>
            </div>
        `;

        return;

    }


    servicos.forEach(function(servico) {

        const card =
            document.createElement("div");

        card.className =
            "servico-admin";


        card.innerHTML = `

            <h4>
                ${escaparHTML(servico.nome)}
            </h4>

            <div class="servico-admin-preco">
                ${formatarPreco(servico.preco)}
            </div>

            <div class="servico-admin-duracao">
                Duração: ${servico.duracao} minutos
            </div>

        `;


        lista.appendChild(card);

    });

}


/* =====================================================
   ESCAPAR HTML
===================================================== */

function escaparHTML(texto) {

    return String(texto)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

}

/* =====================================================
   MENU
===================================================== */

function toggleMenu() {

    document
        .getElementById("sidebar")
        .classList.toggle("aberta");

}


/* =====================================================
   ABRIR PAINEL SERVIÇOS
===================================================== */

function abrirPainelServicos() {

    const painel =
        document.getElementById(
            "painelServicos"
        );

    const agendamento =
        document.getElementById(
            "agendamento"
        );

    const inicio =
        document.getElementById(
            "inicioAgendamento"
        );


    agendamento.classList.remove(
        "visivel"
    );

    inicio.style.display = "none";

    painel.classList.add(
        "visivel"
    );


    document
        .getElementById("sidebar")
        .classList.remove("aberta");


    renderizarServicosAdmin();


    painel.scrollIntoView({
        behavior: "smooth",
        block: "start"
    });

}


/* =====================================================
   RENDERIZAR SERVIÇOS ADMIN
===================================================== */

function renderizarServicosAdmin() {

    const lista =
        document.getElementById(
            "listaServicos"
        );


    lista.innerHTML = "";


    if (servicos.length === 0) {

        lista.innerHTML = `
            <div class="servico-admin">
                <h4>Nenhum serviço cadastrado</h4>
                <p class="servico-admin-duracao">
                    Cadastre seu primeiro serviço acima.
                </p>
            </div>
        `;

        return;

    }


    servicos.forEach(function(servico) {

        const card =
            document.createElement("div");

        card.className =
            "servico-admin";


        card.innerHTML = `

            <h4>
                ${escaparHTML(servico.nome)}
            </h4>

            <div class="servico-admin-preco">
                ${formatarPreco(servico.preco)}
            </div>

            <div class="servico-admin-duracao">
                Duração: ${servico.duracao} minutos
            </div>

            <div class="acoes-servico">

                <button
                    class="editar"
                    onclick="editarServico(${servico.id})"
                >
                    Editar
                </button>

                <button
                    class="excluir"
                    onclick="excluirServico(${servico.id})"
                >
                    Excluir
                </button>

            </div>

        `;


        lista.appendChild(card);

    });

}


/* =====================================================
   ESCAPAR HTML
===================================================== */

function escaparHTML(texto) {

    return String(texto)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

}


/* =====================================================
   CADASTRAR / EDITAR SERVIÇO
===================================================== */

let servicoEditandoId = null;


function salvarServico(event) {

    event.preventDefault();


    const nome =
        document
            .getElementById("nomeServico")
            .value
            .trim();


    const preco =
        Number(
            document
                .getElementById("precoServico")
                .value
        );


    const duracao =
        Number(
            document
                .getElementById("duracaoServico")
                .value
        );


    if (nome.length < 2) {

        alert(
            "Digite um nome válido para o serviço."
        );

        return;

    }


    if (
        isNaN(preco) ||
        preco < 0
    ) {

        alert(
            "Digite um preço válido."
        );

        return;

    }


    if (
        isNaN(duracao) ||
        duracao < 5
    ) {

        alert(
            "Digite uma duração válida."
        );

        return;

    }


    if (servicoEditandoId !== null) {

        const servico =
            servicos.find(
                function(item) {

                    return item.id ===
                        servicoEditandoId;

                }
            );


        if (servico) {

            servico.nome =
                nome;

            servico.preco =
                preco;

            servico.duracao =
                duracao;

        }

        alert(
            "Serviço atualizado com sucesso!"
        );

    } else {

        servicos.push({

            id: Date.now(),

            nome: nome,

            preco: preco,

            duracao: duracao

        });


        alert(
            "Serviço cadastrado com sucesso!"
        );

    }


    salvarServicos();

    limparFormularioServico();

    renderizarServicosAdmin();

    renderizarServicosAgendamento();

}


/* =====================================================
   EDITAR SERVIÇO
===================================================== */

function editarServico(id) {

    const servico =
        servicos.find(
            function(item) {

                return item.id === id;

            }
        );


    if (!servico) {
        return;
    }


    servicoEditandoId =
        id;


    document.getElementById(
        "nomeServico"
    ).value =
        servico.nome;


    document.getElementById(
        "precoServico"
    ).value =
        servico.preco;


    document.getElementById(
        "duracaoServico"
    ).value =
        servico.duracao;


    document.getElementById(
        "tituloFormularioServico"
    ).textContent =
        "Editar serviço";


    document.getElementById(
        "botaoSalvarServico"
    ).textContent =
        "Salvar alteração";


    document
        .getElementById("nomeServico")
        .focus();

}


/* =====================================================
   EXCLUIR SERVIÇO
===================================================== */

function excluirServico(id) {

    const servico =
        servicos.find(
            function(item) {

                return item.id === id;

            }
        );


    if (!servico) {
        return;
    }


    const confirmar =
        confirm(
            `Deseja excluir o serviço "${servico.nome}"?`
        );


    if (!confirmar) {
        return;
    }


    servicos =
        servicos.filter(
            function(item) {

                return item.id !== id;

            }
        );


    salvarServicos();

    renderizarServicosAdmin();

    renderizarServicosAgendamento();


    if (
        servicoSelecionado &&
        servicoSelecionado.id === id
    ) {

        servicoSelecionado = null;

        botaoProximoServico.disabled =
            true;

    }


    alert(
        "Serviço excluído com sucesso!"
    );

}


/* =====================================================
   LIMPAR FORMULÁRIO
===================================================== */

function limparFormularioServico() {

    servicoEditandoId = null;


    document.getElementById(
        "nomeServico"
    ).value = "";


    document.getElementById(
        "precoServico"
    ).value = "";


    document.getElementById(
        "duracaoServico"
    ).value = "";


    document.getElementById(
        "tituloFormularioServico"
    ).textContent =
        "Cadastrar novo serviço";


    document.getElementById(
        "botaoSalvarServico"
    ).textContent =
        "Cadastrar";

}


/* =====================================================
   RENDERIZAR SERVIÇOS NO AGENDAMENTO
===================================================== */

function renderizarServicosAgendamento() {

    const container =
        document.getElementById(
            "servicosContainer"
        );


    if (!container) {
        return;
    }


    container.innerHTML = "";


    if (servicos.length === 0) {

        container.innerHTML = `
            <div class="servico-card">
                <h3>Nenhum serviço disponível</h3>
                <p class="servico-duracao">
                    No momento não há serviços cadastrados.
                </p>
            </div>
        `;

        botaoProximoServico.disabled = true;

        return;

    }


    servicos.forEach(function(servico) {

        const card =
            document.createElement("div");

        card.className =
            "servico-card";


        if (
            servicoSelecionado &&
            Number(servicoSelecionado.id) === Number(servico.id)
        ) {

            card.classList.add(
                "selecionado"
            );

        }


        card.innerHTML = `

            <h3>
                ${escaparHTML(servico.nome)}
            </h3>

            <div class="servico-preco">
                ${formatarPreco(servico.preco)}
            </div>

            <div class="servico-duracao">
                ⏱ ${servico.duracao} minutos
            </div>

        `;


        card.addEventListener(
            "click",
            function() {

                selecionarServico(
                    card,
                    servico
                );

            }
        );


        container.appendChild(card);

    });

}


/* =====================================================
   SELECIONAR SERVIÇO
===================================================== */

function selecionarServico(
    card,
    servico
) {

    document
        .querySelectorAll(
            ".servico-card"
        )
        .forEach(function(item) {

            item.classList.remove(
                "selecionado"
            );

        });


    card.classList.add(
        "selecionado"
    );


    servicoSelecionado =
        servico;


    botaoProximoServico.disabled =
        false;

}


/* =====================================================
   MÁSCARA TELEFONE
===================================================== */

function aplicarMascaraTelefone(input) {

    let valor =
        input.value.replace(/\D/g, "");


    valor =
        valor.substring(0, 11);


    if (valor.length <= 2) {

        input.value =
            valor.length
                ? "(" + valor
                : "";

    } else if (valor.length <= 7) {

        input.value =
            "(" +
            valor.substring(0, 2) +
            ") " +
            valor.substring(2);

    } else {

        input.value =
            "(" +
            valor.substring(0, 2) +
            ") " +
            valor.substring(2, 7) +
            "-" +
            valor.substring(7);

    }

}


document
    .querySelectorAll(
        'input[type="tel"]'
    )
    .forEach(function(input) {

        input.addEventListener(
            "input",
            function() {

                aplicarMascaraTelefone(
                    this
                );

            }
        );

    });


/* =====================================================
   CONSULTAR AGENDAMENTO
===================================================== */

function consultarAgendamento(event) {

    event.preventDefault();


    const input =
        event.target.querySelector(
            'input[type="tel"]'
        );


    const telefone =
        input.value.replace(/\D/g,'');



    if(telefone.length !== 11){

        alert(
            "Digite um telefone válido."
        );

        return;

    }



    fetch(
        "consultar_agendamento.php?telefone="
        + telefone
    )


    .then(response => response.json())


    .then(resultado => {


        if(resultado.sucesso){

    const dados =
        resultado.dados;


    console.log("ID recebido:", dados.id);


    agendamentoConsultaId =
        dados.id;



            document.getElementById("consultaNome").textContent =
                dados.nome || "";


            document.getElementById("consultaTelefone").textContent =
                dados.telefone || input.value;


            document.getElementById("consultaServico").textContent =
                dados.servico || "";


            document.getElementById("consultaValor").textContent =
                formatarPreco(dados.valor || 0);


            document.getElementById("consultaProfissional").textContent =
                dados.profissional || "";


            document.getElementById("consultaData").textContent =
                dados.data_agendamento || dados.data || "";


            document.getElementById("consultaHorario").textContent =
                dados.horario || "";



            document
                .getElementById("modalConsulta")
                .classList.add("aberto");


        }

        else{


            alert(
                resultado.mensagem
            );


        }


    })


    .catch(()=>{


        alert(
            "Erro ao consultar agendamento."
        );


    });


}


/* =====================================================
   CONSULTA MOBILE
===================================================== */

function toggleConsultaMobile() {

    document
        .getElementById(
            "mobileConsultaPanel"
        )
        .classList.toggle(
            "aberto"
        );

}


document.addEventListener(
    "click",
    function(event) {

        const painel =
            document.getElementById(
                "mobileConsultaPanel"
            );

        const botao =
            document.querySelector(
                ".mobile-consulta-button"
            );


        if (
            painel.classList.contains("aberto") &&
            !painel.contains(event.target) &&
            !botao.contains(event.target)
        ) {

            painel.classList.remove(
                "aberto"
            );

        }

    }
);


/* =====================================================
   HORÁRIOS
===================================================== */




const diasSemana = [

    "Dom",
    "Seg",
    "Ter",
    "Qua",
    "Qui",
    "Sex",
    "Sáb"

];


const meses = [

    "Jan",
    "Fev",
    "Mar",
    "Abr",
    "Mai",
    "Jun",
    "Jul",
    "Ago",
    "Set",
    "Out",
    "Nov",
    "Dez"

];


/* =====================================================
   ELEMENTOS
===================================================== */

const agendamento =
    document.getElementById(
        "agendamento"
    );

const inicioAgendamento =
    document.getElementById(
        "inicioAgendamento"
    );

const painelServicos =
    document.getElementById(
        "painelServicos"
    );

const datasContainer =
    document.getElementById(
        "datasContainer"
    );

const horariosContainer =
    document.getElementById(
        "horariosContainer"
    );

const profissionaisContainer =
    document.getElementById(
        "profissionaisContainer"
    );    

const dataSelecionada =
    document.getElementById(
        "dataSelecionada"
    );

const botaoProximoServico =
    document.getElementById(
        "botaoProximoServico"
    );

const botaoProximoProfissional =
    document.getElementById(
        "botaoProximoProfissional"
    );

const botaoProximoData =
    document.getElementById(
        "botaoProximoData"
    );

const botaoFinalizar =
    document.getElementById(
        "botaoFinalizar"
    );

const nomeCliente =
    document.getElementById(
        "nomeCliente"
    );

const telefoneCliente =
    document.getElementById(
        "telefoneCliente"
    );


/* =====================================================
   VARIÁVEIS
===================================================== */

let nomeSelecionado = null;

let telefoneSelecionado = null;

let servicoSelecionado = null;

let profissionalSelecionado = null;

let profissionalSelecionadoId = null;

let dataEscolhida = null;

let horarioSelecionado = null;

let agendamentoConsultaId = null;




/* =====================================================
   INICIAR AGENDAMENTO
===================================================== */

function iniciarAgendamento() {

    document.getElementById("hero").style.display = "none";

    painelServicos.classList.remove(
        "visivel"
    );

    inicioAgendamento.style.display = "none";

    agendamento.classList.add(
        "visivel"
    );

    carregarServicosDoBanco();

    carregarProfissionais();

    mostrarEtapa(1);

    agendamento.scrollIntoView({
        behavior: "smooth",
        block: "start"
    });
}


/* =====================================================
   VALIDAR CLIENTE
===================================================== */

function validarDadosCliente() {

    const nome =
        nomeCliente.value.trim();


    const telefone =
        telefoneCliente.value.trim();


    nomeCliente.classList.remove(
        "erro"
    );

    telefoneCliente.classList.remove(
        "erro"
    );


    if (nome.length < 2) {

        nomeCliente.classList.add(
            "erro"
        );

        alert(
            "Digite seu nome para continuar."
        );

        nomeCliente.focus();

        return false;

    }


    if (
        telefone
            .replace(/\D/g, "")
            .length !== 11
    ) {

        telefoneCliente.classList.add(
            "erro"
        );

        alert(
            "Digite um número de telefone válido."
        );

        telefoneCliente.focus();

        return false;

    }


    nomeSelecionado =
        nome;

    telefoneSelecionado =
        telefone;


    return true;

}


/* =====================================================
   MOSTRAR ETAPA
===================================================== */

function mostrarEtapa(numero) {

    document
        .querySelectorAll(".etapa")
        .forEach(function(etapa) {

            etapa.classList.remove(
                "ativa"
            );

        });


    const etapa =
        document.getElementById(
            "etapa" + numero
        );


    if (etapa) {

        etapa.classList.add(
            "ativa"
        );

    }


    atualizarProgresso(
        numero
    );

}


/* =====================================================
   PROGRESSO
===================================================== */

function atualizarProgresso(numero) {

    document
        .querySelectorAll(
            ".progresso-item"
        )
        .forEach(function(item) {

            item.classList.remove(
                "ativo"
            );

        });


    for (
        let i = 1;
        i <= numero;
        i++
    ) {

        const item =
            document.getElementById(
                "progresso" + i
            );


        if (item) {

            item.classList.add(
                "ativo"
            );

        }

    }

}


/* =====================================================
   SELECIONAR PROFISSIONAL
===================================================== */

async function carregarProfissionais() {

    profissionaisContainer.innerHTML = `
        <p>Carregando profissionais...</p>
    `;

    try {

        const resposta =
            await fetch(
                "listar_funcionarios.php"
            );

        const dados =
            await resposta.json();

        if (!dados.sucesso) {

            profissionaisContainer.innerHTML = `
                <p>
                    Não foi possível carregar os profissionais.
                </p>
            `;

            return;
        }


        profissionaisContainer.innerHTML = "";


        if (
            !dados.funcionarios ||
            dados.funcionarios.length === 0
        ) {

            profissionaisContainer.innerHTML = `
                <p>
                    Nenhum profissional disponível.
                </p>
            `;

            return;
        }


        dados.funcionarios.forEach(
            function(funcionario) {

                const card =
                    document.createElement("div");

                card.className =
                    "profissional";


                const foto =
                    funcionario.foto ||
                    "https://i.pravatar.cc/300?img=12";


                card.innerHTML = `

                    <img
                        class="profissional-foto"
                        src="${escaparHTML(foto)}"
                        alt="${escaparHTML(funcionario.nome)}"
                    >

                    <span class="profissional-nome">
                        ${escaparHTML(funcionario.nome)}
                    </span>

                `;


                card.addEventListener(
                    "click",
                    function() {

                        selecionarProfissional(
                            card,
                            funcionario.id,
                            funcionario.nome
                        );

                    }
                );


                profissionaisContainer.appendChild(
                    card
                );

            }
        );


    } catch (erro) {

        console.error(erro);

        profissionaisContainer.innerHTML = `
            <p>
                Erro ao carregar profissionais.
            </p>
        `;
    }
}

function selecionarProfissional(
    elemento,
    id,
    nome
) {

    document
        .querySelectorAll(
            ".profissional"
        )
        .forEach(function(profissional) {

            profissional.classList.remove(
                "selecionado"
            );

        });


    elemento.classList.add(
        "selecionado"
    );


    profissionalSelecionadoId =
        Number(id);

    profissionalSelecionado =
        nome;


    horarioSelecionado =
        null;


    botaoProximoProfissional.disabled =
        false;

}


/* =====================================================
   PRÓXIMA ETAPA
===================================================== */

async function proximaEtapa(numero) {


    /* CLIENTE */

    if (numero === 2) {

        if (!validarDadosCliente()) {

            return;

        }

        await carregarServicosDoBanco();

    }


    /* SERVIÇO */

    if (numero === 3) {

        if (!servicoSelecionado) {

            alert(
                "Selecione um serviço para continuar."
            );

            return;

        }

    }


    /* PROFISSIONAL */

    if (numero === 4) {

        if (!profissionalSelecionado) {

            alert(
                "Selecione um profissional para continuar."
            );

            return;

        }


        gerarDatas();

    }


    /* DATA */

    if (numero === 5) {

        if (!dataEscolhida) {

            alert(
                "Selecione uma data para continuar."
            );

            return;

        }


        gerarHorarios();

    }


    mostrarEtapa(
        numero
    );


    agendamento.scrollIntoView({

        behavior: "smooth",

        block: "start"

    });

}


/* =====================================================
   VOLTAR
===================================================== */

function voltarEtapa(numero) {

    mostrarEtapa(
        numero
    );


    agendamento.scrollIntoView({

        behavior: "smooth",

        block: "start"

    });

}


/* =====================================================
   GERAR DATAS
===================================================== */

function gerarDatas() {

    datasContainer.innerHTML = "";


    const hoje =
        new Date();


    for (
        let i = 0;
        i < 5;
        i++
    ) {

        const data =
            new Date(hoje);


        data.setDate(
            hoje.getDate() + i
        );


        const card =
            document.createElement(
                "div"
            );


        card.classList.add(
            "data-card"
        );


        const semana =
            document.createElement(
                "span"
            );


        semana.classList.add(
            "data-semana"
        );


        semana.textContent =
            i === 0
                ? "Hoje"
                : diasSemana[
                    data.getDay()
                ];


        const numero =
            document.createElement(
                "span"
            );


        numero.classList.add(
            "data-numero"
        );


        numero.textContent =
            String(
                data.getDate()
            ).padStart(2, "0");


        const mes =
            document.createElement(
                "span"
            );


        mes.classList.add(
            "data-mes"
        );


        mes.textContent =
            meses[
                data.getMonth()
            ];


        card.appendChild(
            semana
        );

        card.appendChild(
            numero
        );

        card.appendChild(
            mes
        );


        card.addEventListener(
            "click",
            function() {

                selecionarData(
                    card,
                    data
                );

            }
        );


        datasContainer.appendChild(
            card
        );


        if (i === 0) {

            selecionarData(
                card,
                data
            );

        }

    }

}


/* =====================================================
   SELECIONAR DATA
===================================================== */

function selecionarData(
    card,
    data
) {

    document
        .querySelectorAll(
            ".data-card"
        )
        .forEach(function(item) {

            item.classList.remove(
                "selecionada"
            );

        });


    card.classList.add(
        "selecionada"
    );


    dataEscolhida =
        new Date(data);


    const dia =
        String(
            data.getDate()
        ).padStart(2, "0");


    const mes =
        String(
            data.getMonth() + 1
        ).padStart(2, "0");


    const ano =
        data.getFullYear();


    dataSelecionada.textContent =
        `${dia}/${mes}/${ano}`;


    botaoProximoData.disabled =
        false;


    horarioSelecionado =
        null;


    botaoFinalizar.disabled =
        true;

if (profissionalSelecionadoId) {

    gerarHorarios();

   }
}


/* =====================================================
   GERAR HORÁRIOS
===================================================== */

async function gerarHorarios() {

    horariosContainer.innerHTML = `
        <p>
            Carregando horários...
        </p>
    `;


    botaoFinalizar.disabled = true;

    horarioSelecionado = null;


    if (!profissionalSelecionadoId) {

        horariosContainer.innerHTML = `
            <p>
                Selecione um profissional.
            </p>
        `;

        return;
    }


    if (!dataEscolhida) {

        horariosContainer.innerHTML = `
            <p>
                Selecione uma data.
            </p>
        `;

        return;
    }


    const dia =
        String(
            dataEscolhida.getDate()
        ).padStart(2, "0");


    const mes =
        String(
            dataEscolhida.getMonth() + 1
        ).padStart(2, "0");


    const ano =
        dataEscolhida.getFullYear();


    const dataFormatada =
        `${dia}/${mes}/${ano}`;


    const duracao =
        servicoSelecionado
            ? Number(servicoSelecionado.duracao)
            : 30;


    try {

        const url =
            "consultar_horarios.php" +
            "?profissional_id=" +
            encodeURIComponent(
                profissionalSelecionadoId
            ) +
            "&data=" +
            encodeURIComponent(
                dataFormatada
            ) +
            "&duracao=" +
            encodeURIComponent(
                duracao
            );


        const resposta =
            await fetch(url);


        const dados =
            await resposta.json();


        if (!dados.sucesso) {

            horariosContainer.innerHTML = `
                <p>
                    ${escaparHTML(
                        dados.mensagem ||
                        "Não foi possível consultar os horários."
                    )}
                </p>
            `;

            return;
        }


        horariosContainer.innerHTML = "";


        if (
            !dados.horarios ||
            dados.horarios.length === 0
        ) {

            horariosContainer.innerHTML = `
                <p>
                    Nenhum horário disponível para este dia.
                </p>
            `;

            return;
        }


        dados.horarios.forEach(
            function(horario) {

                const botao =
                    document.createElement("div");


                botao.classList.add(
                    "horario"
                );


                botao.textContent =
                    horario;


                botao.addEventListener(
                    "click",
                    function() {

                        selecionarHorario(
                            botao,
                            horario
                        );

                    }
                );


                horariosContainer.appendChild(
                    botao
                );

            }
        );


    } catch (erro) {

        console.error(erro);

        horariosContainer.innerHTML = `
            <p>
                Erro ao consultar horários.
            </p>
        `;
    }
}


/* =====================================================
   SELECIONAR HORÁRIO
===================================================== */

function selecionarHorario(
    botao,
    horario
) {

    document
        .querySelectorAll(
            ".horario"
        )
        .forEach(function(item) {

            item.classList.remove(
                "selecionado"
            );

        });


    botao.classList.add(
        "selecionado"
    );


    horarioSelecionado =
        horario;


    botaoFinalizar.disabled =
        false;

}


/* =====================================================
   FINALIZAR AGENDAMENTO
===================================================== */

function finalizarAgendamento() {

    if (!nomeSelecionado) {

        alert("Informe seu nome.");

        mostrarEtapa(1);

        return;
    }


    if (!telefoneSelecionado) {

        alert("Informe seu telefone.");

        mostrarEtapa(1);

        return;
    }


    if (!servicoSelecionado) {

        alert("Selecione um serviço.");

        mostrarEtapa(2);

        return;
    }


    if (!profissionalSelecionado) {

        alert("Selecione um profissional.");

        mostrarEtapa(3);

        return;
    }


    if (!dataEscolhida) {

        alert("Selecione uma data.");

        mostrarEtapa(4);

        return;
    }


    if (!horarioSelecionado) {

        alert("Selecione um horário.");

        return;
    }


    const dia =
        String(
            dataEscolhida.getDate()
        ).padStart(2, "0");


    const mes =
        String(
            dataEscolhida.getMonth() + 1
        ).padStart(2, "0");


    const ano =
        dataEscolhida.getFullYear();


    const dataFormatada =
        `${dia}/${mes}/${ano}`;


    /*
     * Preenche o modal
     */

    document.getElementById("modalNome").textContent =
        nomeSelecionado;

    document.getElementById("modalTelefone").textContent =
        telefoneSelecionado;

    document.getElementById("modalServico").textContent =
        servicoSelecionado.nome;

    document.getElementById("modalDuracao").textContent =
        servicoSelecionado.duracao + " minutos";

    document.getElementById("modalPreco").textContent =
        formatarPreco(servicoSelecionado.preco);

    document.getElementById("modalProfissional").textContent =
        profissionalSelecionado;

    document.getElementById("modalData").textContent =
        dataFormatada;

    document.getElementById("modalHorario").textContent =
        horarioSelecionado;


    /*
     * Abre o modal
     */

    document
        .getElementById("modalConfirmacao")
        .classList.add("aberto");

}
/* =====================================================
   FECHAR MODAL
===================================================== */

function fecharModalConfirmacao() {

    document
        .getElementById("modalConfirmacao")
        .classList.remove("aberto");

}


/* =====================================================
   CONFIRMAR AGENDAMENTO
===================================================== */

async function confirmarAgendamento() {

    const botaoConfirmar =
        document.querySelector(
            ".modal-botao-confirmar"
        );


    botaoConfirmar.disabled = true;


    if (!profissionalSelecionadoId) {

        alert(
            "Selecione um profissional."
        );

        botaoConfirmar.disabled = false;

        return;
    }


    const dataFormatada =
        document.getElementById(
            "modalData"
        ).textContent;


    const dados = {

        nome:
            nomeSelecionado,

        telefone:
            telefoneSelecionado
                .replace(/\D/g, ""),

        servico:
            servicoSelecionado.nome,

        valor:
            servicoSelecionado.preco,

        profissional_id:
            profissionalSelecionadoId,

        horario:
            horarioSelecionado,

        duracao:
            Number(
                servicoSelecionado.duracao
            ),

        data:
            dataFormatada
    };


    try {

        const resposta =
            await fetch(
                "salvar_agendamento.php",
                {

                    method: "POST",

                    headers: {
                        "Content-Type":
                            "application/json"
                    },

                    body:
                        JSON.stringify(dados)

                }
            );


        const resultado =
            await resposta.json();


        if (resultado.sucesso) {

            document.getElementById(
                "conteudoConfirmacao"
            ).style.display =
                "none";


            document.getElementById(
                "modalSucesso"
            ).classList.add(
                "visivel"
            );


            window.setTimeout(
                function() {

                    window.location.replace(
                        "index.php"
                    );

                },
                1800
            );


        } else {

            botaoConfirmar.disabled =
                false;


            alert(
                resultado.mensagem
            );


            /*
             * Atualiza os horários novamente.
             *
             * Isso é importante se outro cliente
             * acabou de reservar o horário.
             */

            gerarHorarios();

        }


    } catch (erro) {

        console.error(erro);

        botaoConfirmar.disabled =
            false;

        alert(
            "Erro ao salvar agendamento."
        );
    }
}

/* =====================================================
   DESMARCAR AGENDAMENTO
===================================================== */

function desmarcarAgendamento(){


    if(!agendamentoConsultaId){

        alert(
            "Agendamento não encontrado."
        );

        return;

    }


    const confirmar =
        confirm(
            "Deseja realmente desmarcar este horário?"
        );


    if(!confirmar){

        return;

    }



    fetch(
        "excluir_agendamento.php",
        {

            method:"POST",

            headers:{
                "Content-Type":"application/json"
            },


            body:JSON.stringify({

                id:
                agendamentoConsultaId

            })


        }
    )


    .then(response=>response.json())


    .then(resultado=>{


        if(resultado.sucesso){


            alert(
                "Agendamento desmarcado com sucesso!"
            );


            fecharModalConsulta();


            agendamentoConsultaId = null;


        }

        else{


            alert(
                resultado.mensagem
            );


        }


    })


    .catch(()=>{


        alert(
            "Erro ao desmarcar agendamento."
        );


    });


}

/* =====================================================
   FINALIZAR MODAL
===================================================== */

function fecharModalFinal() {

    document
        .getElementById("modalConfirmacao")
        .classList.remove("aberto");


    document.getElementById(
        "conteudoConfirmacao"
    ).style.display = "block";


    document.getElementById(
        "modalSucesso"
    ).classList.remove("visivel");


    /*
     * Reseta o agendamento para permitir
     * um novo agendamento
     */

    nomeSelecionado = null;

    telefoneSelecionado = null;

    servicoSelecionado = null;

    profissionalSelecionado = null;

    profissionalSelecionadoId = null;

    dataEscolhida = null;

    horarioSelecionado = null;


    nomeCliente.value = "";

    telefoneCliente.value = "";


    document
        .querySelectorAll(
            ".servico-card"
        )
        .forEach(function(card) {

            card.classList.remove(
                "selecionado"
            );

        });


    document
        .querySelectorAll(
            ".profissional"
        )
        .forEach(function(profissional) {

            profissional.classList.remove(
                "selecionado"
            );

        });


    botaoProximoServico.disabled = true;

    botaoProximoProfissional.disabled = true;

    botaoProximoData.disabled = true;

    botaoFinalizar.disabled = true;


    mostrarEtapa(1);

}


/* =====================================================
   INICIALIZAÇÃO
===================================================== */

carregarServicosDoBanco();

function fecharModalConsulta(){

    document
        .getElementById("modalConsulta")
        .classList.remove("aberto");

}
</script>
<!-- =====================================================
     MODAL CONSULTA AGENDAMENTO
===================================================== -->

<div
    class="modal-confirmacao"
    id="modalConsulta"
>

    <div class="modal-caixa">


        <div class="modal-cabecalho">

            <div class="modal-icone">
                📅
            </div>


            <h2>
                Seu Agendamento
            </h2>


            <p>
                Confira os detalhes do seu horário reservado.
            </p>


        </div>



        <div class="modal-detalhes">


            <div class="modal-detalhe">

                <span>
                    Nome
                </span>

                <strong id="consultaNome"></strong>

            </div>



            <div class="modal-detalhe">

                <span>
                    Telefone
                </span>

                <strong id="consultaTelefone"></strong>

            </div>



            <div class="modal-detalhe">

                <span>
                    Serviço
                </span>

                <strong id="consultaServico"></strong>

            </div>



            <div class="modal-detalhe preco">

                <span>
                    Valor
                </span>

                <strong id="consultaValor"></strong>

            </div>



            <div class="modal-detalhe">

                <span>
                    Profissional
                </span>

                <strong id="consultaProfissional"></strong>

            </div>



            <div class="modal-detalhe">

                <span>
                    Data
                </span>

                <strong id="consultaData"></strong>

            </div>



            <div class="modal-detalhe">

                <span>
                    Horário
                </span>

                <strong id="consultaHorario"></strong>

            </div>


        </div>



        <div class="modal-acoes">

    <button
        class="modal-botao-editar"
        onclick="fecharModalConsulta()"
    >
        Fechar
    </button>


    <button
        class="modal-botao-confirmar"
        onclick="desmarcarAgendamento()"
    >
        Desmarcar
    </button>

</div>


    </div>

</div>
</body>
<footer class="footer">
<div class="footer-bottom">
        © 2026 AgendaLogo — Todos os direitos reservados.
    </div>

</footer>

</html>
