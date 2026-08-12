<?php
session_start();

if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php?erro=acesso');
    exit;
}

require 'conexao.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$consulta = $pdo->query(
    'SELECT id, nome, telefone, servico, profissional, horario, confirmado
     FROM agendamentos
     ORDER BY id DESC'
);
$agendamentos = $consulta->fetchAll(PDO::FETCH_ASSOC);

$mostrarSucesso = ($_GET['login'] ?? '') === 'sucesso';
$mensagem = $_GET['mensagem'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Agenda Logo!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        #areaServicos {
            display: none;
            width: 100%;
        }

        .botao-sair-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .botoes-painel {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .botao-funcionarios {
            padding: 12px 18px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #151515;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .botao-funcionarios:hover {
            background: #ff1a1a;
            border-color: #ff1a1a;
            transform: translateY(-1px);
        }

        .botao-voltar-agendamentos {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 16px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #151515;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .botao-voltar-agendamentos:hover {
            background: #222;
            border-color: #ff1a1a;
            color: #ff1a1a;
        }

        #areaFuncionarios {
            display: none;
            width: 100%;
        }

        #iframeFuncionarios {
            display: block;
            width: 100%;
            height: 1200px;
            border: 0;
            border-radius: 12px;
            background: #050505;
        }

        .botao-sair {
            padding: 12px 18px;
            border: 1px solid #b30000;
            border-radius: 8px;
            background: #8c0000;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: .2s;
        }

        .botao-sair:hover {
            background: #b30000;
            transform: translateY(-1px);
        }

        :root {
            --vermelho: #ff1a1a;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            padding-top: 70px;
            background: #000;
            color: #fff;
        }

        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 2000;
            display: flex;
            align-items: center;
            width: 100%;
            height: 70px;
            padding: 0 30px;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: 0 4px 20px rgba(0,0,0,.15);
        }

        .left-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 0;
            background: transparent;
            color: #000;
            font-size: 26px;
            cursor: pointer;
        }

        .menu-icon:hover {
            color: var(--vermelho);
        }

        .logo {
            color: #fa0707;
            font-size: 20px;
            font-weight: 600;
        }

        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            z-index: 1900;
            display: flex;
            flex-direction: column;
            width: 280px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            background: #fff;
            box-shadow: 5px 0 30px rgba(0,0,0,.7);
            pointer-events: none;
            transform: translateX(-100%);
            transition: transform .3s ease;
        }

        .sidebar.aberta {
            pointer-events: auto;
            transform: translateX(0);
        }

        .sidebar a {
            display: block;
            width: 100%;
            padding: 17px 20px;
            border-bottom: 1px solid #e5e5e5;
            background: #fff;
            color: #111;
            font-weight: 500;
            text-decoration: none;
            transition: .2s;
        }

        .sidebar a:hover {
            padding-left: 25px;
            background: #111;
            color: var(--vermelho);
        }

        .sidebar .sidebar-login {
            margin-top: auto;
            border-top: 1px solid #e5e5e5;
        }

        .painel-area {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 48px 30px 70px;
        }

        .painel-cabecalho {
            margin-bottom: 28px;
            text-align: center;
        }

        .painel-cabecalho h1 {
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 500;
        }

        .painel-cabecalho p {
            color: #a1a1aa;
            font-size: 14px;
        }

        .tabela-agendamentos {
            overflow: hidden;
            border: 1px solid #292929;
            border-radius: 14px;
            background: #080808;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 17px 18px;
            border-bottom: 1px solid #292929;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #111;
            color: #ff1a1a;
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
        }

        tbody tr {
            transition: background .2s;
        }

        tbody tr:hover {
            background: #111;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .sem-agendamentos {
            padding: 45px 20px;
            color: #a1a1aa;
            text-align: center;
        }

        .mensagem-painel {
            max-width: 640px;
            margin: 0 auto 20px;
            padding: 12px 16px;
            border: 1px solid #248a3d;
            border-radius: 8px;
            background: #092411;
            color: #b9f6c8;
            font-size: 14px;
            text-align: center;
        }

        .mensagem-painel.erro {
            border-color: #ff1a1a;
            background: #260000;
            color: #ffb3b3;
        }

        .status-confirmado {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            margin-right: 8px;
            border-radius: 50%;
            background: #1fa247;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            vertical-align: middle;
        }

        .acoes-agendamento {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            min-width: 240px;
        }

        .acoes-agendamento form {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .acoes-agendamento input[type="time"] {
            width: 94px;
            padding: 7px;
            border: 1px solid #333;
            border-radius: 6px;
            outline: none;
            background: #101010;
            color: #fff;
        }

        .botao-acao {
            padding: 8px 10px;
            border: 1px solid #333;
            border-radius: 6px;
            background: #151515;
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .botao-acao:hover {
            transform: translateY(-1px);
        }

        .botao-acao:disabled {
            opacity: .65;
            cursor: default;
        }

        .botao-acao:disabled:hover {
            transform: none;
        }

        .botao-confirmar {
            border-color: #248a3d;
            color: #aaf0b9;
        }

        .botao-confirmar:hover {
            background: #1b6e32;
            color: #fff;
        }

        .botao-editar:hover {
            border-color: #fff;
        }

        .botao-excluir {
            border-color: #b30000;
            color: #ffaaaa;
        }

        .botao-excluir:hover {
            background: #8c0000;
            color: #fff;
        }

        .confirmado-texto {
            color: #72e590;
            font-size: 12px;
            font-weight: 500;
        }

        .modal-sucesso {
            position: fixed;
            inset: 0;
            z-index: 3000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0,0,0,.72);
        }

        .modal-sucesso.visivel {
            display: flex;
        }

        .modal-caixa {
            width: 100%;
            max-width: 390px;
            padding: 32px 28px;
            border: 1px solid #ff1a1a;
            border-radius: 15px;
            background: #080808;
            box-shadow: 0 0 30px rgba(255,0,0,.25);
            text-align: center;
        }

        .modal-icone {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #ff1a1a;
            color: #fff;
            font-size: 30px;
            font-weight: 600;
        }

        .modal-caixa h1 {
            margin-bottom: 10px;
            font-size: 23px;
            font-weight: 500;
        }

        .modal-caixa p {
            color: #a1a1aa;
            font-size: 14px;
        }

        @media (max-width: 700px) {
            .botoes-painel {
                justify-content: stretch;
            }

            .botoes-painel .botao-funcionarios,
            .botoes-painel .botao-sair {
                flex: 1;
                text-align: center;
            }

            .topbar {
                padding: 0 15px;
            }

            .sidebar {
                width: 80%;
                max-width: 280px;
            }

            .painel-area {
                padding: 35px 15px 55px;
            }

            .painel-cabecalho h1 {
                font-size: 24px;
            }

            .tabela-agendamentos {
                border: 0;
                background: transparent;
            }

            table,
            tbody,
            tr,
            td {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tbody {
                display: grid;
                gap: 15px;
            }

            tbody tr {
                overflow: hidden;
                border: 1px solid #292929;
                border-radius: 12px;
                background: #080808;
            }

            td {
                display: flex;
                justify-content: space-between;
                gap: 18px;
                padding: 13px 15px;
                border-bottom: 1px solid #292929;
                text-align: right;
            }

            td::before {
                content: attr(data-label);
                color: #ff1a1a;
                font-size: 12px;
                font-weight: 500;
                text-align: left;
            }

            td.acoes-celula {
                display: block;
                text-align: left;
            }

            td.acoes-celula::before {
                display: block;
                margin-bottom: 10px;
            }

            .acoes-agendamento {
                min-width: 0;
            }

            .modal-caixa {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="left-area">
        <button
            class="menu-icon"
            type="button"
            onclick="toggleMenu()"
            aria-label="Abrir menu"
        >☰</button>

        <div class="logo">
            Agenda Logo!
        </div>
    </div>
</header>

<nav class="sidebar" id="sidebar" aria-label="Menu principal">
    <a href="index.php#">Planos Mensais</a>
    <a href="index.php#">Quem Somos?</a>
    <a href="index.php#">Endereço</a>
    <a href="index.php#">Fale conosco</a>
    <a class="sidebar-login" href="login.php">Login</a>
</nav>

<main class="painel-area">

    

    <div class="botoes-painel">

        <button
            type="button"
            class="botao-funcionarios"
            onclick="mostrarFuncionarios()"
        >
            👥 Funcionários
        </button>

        <button
            type="button"
            class="botao-funcionarios"
            onclick="mostrarServicos()"
        >
            ✂️ Serviços
        </button>

        <a href="logout.php" class="botao-sair">
            🚪 Sair
        </a>

    </div>

    <?php if ($mensagem === 'confirmado'): ?>

        <p class="mensagem-painel">
            Agendamento confirmado com sucesso.
        </p>

    <?php elseif ($mensagem === 'editado'): ?>

        <p class="mensagem-painel">
            Horário atualizado com sucesso.
        </p>

    <?php elseif ($mensagem === 'excluido'): ?>

        <p class="mensagem-painel">
            Agendamento excluído com sucesso.
        </p>

    <?php elseif ($mensagem === 'horario_invalido'): ?>

        <p class="mensagem-painel erro">
            Informe um horário válido.
        </p>

    <?php elseif ($mensagem === 'erro'): ?>

        <p class="mensagem-painel erro">
            Não foi possível concluir a ação.
        </p>

    <?php endif; ?>


    <div id="areaAgendamentos">

        <section
            class="tabela-agendamentos"
            aria-label="Lista de agendamentos"
        >

            <table>

                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Profissional</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody id="corpoAgendamentos">

                    <?php if (empty($agendamentos)): ?>

                        <tr>
                            <td
                                class="sem-agendamentos"
                                colspan="6"
                            >
                                Nenhum agendamento encontrado.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($agendamentos as $agendamento): ?>

                            <tr>

                                <td data-label="Nome">

                                    <?php if ($agendamento['confirmado']): ?>

                                        <span
                                            class="status-confirmado"
                                            title="Confirmado"
                                        >✓</span>

                                    <?php endif; ?>

                                    <?= htmlspecialchars(
                                        $agendamento['nome'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </td>

                                <td data-label="Telefone">
                                    <?= htmlspecialchars(
                                        $agendamento['telefone'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </td>

                                <td data-label="Serviço">
                                    <?= htmlspecialchars(
                                        $agendamento['servico'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </td>

                                <td data-label="Profissional">
                                    <?= htmlspecialchars(
                                        $agendamento['profissional'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </td>

                                <td data-label="Horário">
                                    <?= htmlspecialchars(
                                        $agendamento['horario'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </td>

                                <td
                                    class="acoes-celula"
                                    data-label="Ações"
                                >

                                    <div class="acoes-agendamento">

                                        <?php if ($agendamento['confirmado']): ?>

                                            <button
                                                class="botao-acao botao-confirmar"
                                                type="button"
                                                disabled
                                            >
                                                Confirmado
                                            </button>

                                        <?php else: ?>

                                            <form
                                                action="gerenciar_agendamento.php"
                                                method="post"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="csrf_token"
                                                    value="<?= htmlspecialchars(
                                                        $_SESSION['csrf_token'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int) $agendamento['id'] ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="acao"
                                                    value="confirmar"
                                                >

                                                <button
                                                    class="botao-acao botao-confirmar"
                                                    type="submit"
                                                >
                                                    Concluir
                                                </button>

                                            </form>

                                        <?php endif; ?>


                                        <form
                                            action="gerenciar_agendamento.php"
                                            method="post"
                                        >

                                            <input
                                                type="hidden"
                                                name="csrf_token"
                                                value="<?= htmlspecialchars(
                                                    $_SESSION['csrf_token'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= (int) $agendamento['id'] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="acao"
                                                value="editar"
                                            >

                                            <input
                                                type="time"
                                                name="horario"
                                                value="<?= htmlspecialchars(
                                                    $agendamento['horario'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                                required
                                            >

                                            <button
                                                class="botao-acao botao-editar"
                                                type="submit"
                                            >
                                                Editar
                                            </button>

                                        </form>


                                        <form
                                            action="gerenciar_agendamento.php"
                                            method="post"
                                            onsubmit="return confirm('Excluir este agendamento?');"
                                        >

                                            <input
                                                type="hidden"
                                                name="csrf_token"
                                                value="<?= htmlspecialchars(
                                                    $_SESSION['csrf_token'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= (int) $agendamento['id'] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="acao"
                                                value="excluir"
                                            >

                                            <button
                                                class="botao-acao botao-excluir"
                                                type="submit"
                                            >
                                                Excluir
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </section>

    </div>


    <div id="areaFuncionarios">

        <button
            type="button"
            class="botao-voltar-agendamentos"
            onclick="mostrarAgendamentos()"
        >
            ← Voltar aos Agendamentos
        </button>

        <iframe
            id="iframeFuncionarios"
            src="funcionarios.php"
            title="Funcionários"
            loading="lazy"
        ></iframe>

    </div>


    <div id="areaServicos">

        <button
            type="button"
            class="botao-voltar-agendamentos"
            onclick="mostrarAgendamentos()"
        >
            ← Voltar aos Agendamentos
        </button>

        <?php include 'cadastro_servicos.php'; ?>

    </div>

</main>


<div
    class="modal-sucesso<?= $mostrarSucesso ? ' visivel' : '' ?>"
    id="modalSucesso"
    role="dialog"
    aria-modal="true"
    aria-labelledby="titulo-sucesso"
>

    <div class="modal-caixa">

        <div class="modal-icone">
            ✓
        </div>

        <h1 id="titulo-sucesso">
            Login realizado com sucesso!
        </h1>

        <p>
            Sua conta foi autenticada.
        </p>

    </div>

</div>


<script>

function toggleMenu() {
    document
        .getElementById('sidebar')
        .classList
        .toggle('aberta');
}


const modalSucesso =
    document.getElementById('modalSucesso');

if (modalSucesso.classList.contains('visivel')) {

    window.setTimeout(function () {

        modalSucesso.classList.remove('visivel');

        window.history.replaceState(
            {},
            document.title,
            'painel.php'
        );

    }, 2200);
}


const mensagemAcao =
    <?= json_encode(
        $mensagem,
        JSON_HEX_TAG |
        JSON_HEX_APOS |
        JSON_HEX_AMP |
        JSON_HEX_QUOT
    ) ?>;


if (mensagemAcao) {

    window.setTimeout(function () {

        window.location.replace('painel.php');

    }, 1800);
}


const corpoAgendamentos =
    document.getElementById('corpoAgendamentos');


const csrfToken =
    <?= json_encode(
        $_SESSION['csrf_token'],
        JSON_HEX_TAG |
        JSON_HEX_APOS |
        JSON_HEX_AMP |
        JSON_HEX_QUOT
    ) ?>;


let ultimaAssinatura =
    <?= json_encode(
        json_encode($agendamentos),
        JSON_HEX_TAG |
        JSON_HEX_APOS |
        JSON_HEX_AMP |
        JSON_HEX_QUOT
    ) ?>;


function escaparHtml(valor) {

    return String(valor).replace(
        /[&<>"']/g,
        function (caractere) {

            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[caractere];

        }
    );

}


function campoOculto(nome, valor) {

    return `<input
        type="hidden"
        name="${nome}"
        value="${escaparHtml(valor)}"
    >`;

}


function renderizarAgendamentos(agendamentos) {

    if (!agendamentos.length) {

        corpoAgendamentos.innerHTML =
            '<tr><td class="sem-agendamentos" colspan="6">Nenhum agendamento encontrado.</td></tr>';

        return;
    }


    corpoAgendamentos.innerHTML =
        agendamentos.map(function (agendamento) {

            const confirmado =
                Number(agendamento.confirmado) === 1;


            const botaoConfirmar =
                confirmado

                    ? '<button class="botao-acao botao-confirmar" type="button" disabled>Confirmado</button>'

                    : `<form
                            action="gerenciar_agendamento.php"
                            method="post"
                       >

                            ${campoOculto(
                                'csrf_token',
                                csrfToken
                            )}

                            ${campoOculto(
                                'id',
                                agendamento.id
                            )}

                            ${campoOculto(
                                'acao',
                                'confirmar'
                            )}

                            <button
                                class="botao-acao botao-confirmar"
                                type="submit"
                            >
                                Confirmar
                            </button>

                       </form>`;


            return `<tr>

                <td data-label="Nome">
                    ${
                        confirmado
                            ? '<span class="status-confirmado" title="Confirmado">✓</span>'
                            : ''
                    }

                    ${escaparHtml(agendamento.nome)}
                </td>

                <td data-label="Telefone">
                    ${escaparHtml(agendamento.telefone)}
                </td>

                <td data-label="Serviço">
                    ${escaparHtml(agendamento.servico)}
                </td>

                <td data-label="Profissional">
                    ${escaparHtml(agendamento.profissional)}
                </td>

                <td data-label="Horário">
                    ${escaparHtml(agendamento.horario)}
                </td>

                <td
                    class="acoes-celula"
                    data-label="Ações"
                >

                    <div class="acoes-agendamento">

                        ${botaoConfirmar}

                        <form
                            action="gerenciar_agendamento.php"
                            method="post"
                        >

                            ${campoOculto(
                                'csrf_token',
                                csrfToken
                            )}

                            ${campoOculto(
                                'id',
                                agendamento.id
                            )}

                            ${campoOculto(
                                'acao',
                                'editar'
                            )}

                            <input
                                type="time"
                                name="horario"
                                value="${escaparHtml(agendamento.horario)}"
                                required
                            >

                            <button
                                class="botao-acao botao-editar"
                                type="submit"
                            >
                                Editar
                            </button>

                        </form>


                        <form
                            action="gerenciar_agendamento.php"
                            method="post"
                            onsubmit="return window.confirm('Excluir este agendamento?');"
                        >

                            ${campoOculto(
                                'csrf_token',
                                csrfToken
                            )}

                            ${campoOculto(
                                'id',
                                agendamento.id
                            )}

                            ${campoOculto(
                                'acao',
                                'excluir'
                            )}

                            <button
                                class="botao-acao botao-excluir"
                                type="submit"
                            >
                                Excluir
                            </button>

                        </form>

                    </div>

                </td>

            </tr>`;

        }).join('');

}


function atualizarAgendamentos() {

    fetch(
        'listar_agendamentos.php',
        {
            cache: 'no-store'
        }
    )

    .then(function (resposta) {

        if (resposta.status === 401) {

            window.location.href =
                'login.php?erro=acesso';

            throw new Error(
                'Sessão encerrada.'
            );
        }

        if (!resposta.ok) {

            throw new Error(
                'Falha ao atualizar os agendamentos.'
            );

        }

        return resposta.json();

    })

    .then(function (dados) {

        const novaAssinatura =
            JSON.stringify(
                dados.agendamentos
            );


        if (
            novaAssinatura !==
            ultimaAssinatura
        ) {

            renderizarAgendamentos(
                dados.agendamentos
            );

            ultimaAssinatura =
                novaAssinatura;

        }

    })

    .catch(function () {

        // A próxima atualização automática tentará novamente.

    });

}


window.setInterval(
    atualizarAgendamentos,
    1000
);


function esconderTodasAsAreas() {

    document
        .getElementById('areaAgendamentos')
        .style
        .display = 'none';

    document
        .getElementById('areaFuncionarios')
        .style
        .display = 'none';

    document
        .getElementById('areaServicos')
        .style
        .display = 'none';

}


function mostrarAgendamentos() {

    esconderTodasAsAreas();

    document
        .getElementById('areaAgendamentos')
        .style
        .display = 'block';

}


function mostrarFuncionarios() {

    esconderTodasAsAreas();

    document
        .getElementById('areaFuncionarios')
        .style
        .display = 'block';

}


function mostrarServicos() {

    esconderTodasAsAreas();

    document
        .getElementById('areaServicos')
        .style
        .display = 'block';


    if (
        typeof carregarServicos ===
        'function'
    ) {

        carregarServicos();

    }

}

</script>

</body>
</html>