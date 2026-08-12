<?php
session_start();

$mensagemErro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Agenda Logo!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
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
            display: flex;
            flex-direction: column;
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, .15);
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
            box-shadow: 5px 0 30px rgba(0, 0, 0, .7);
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
            color: #111;
            background: #fff;
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

        .login-area {
            display: flex;
            flex: 1;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 40px 20px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 38px;
            border: 1px solid #292929;
            border-radius: 15px;
            background: #080808;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .5);
        }

        .login-card h1 {
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 500;
            text-align: center;
        }

        .login-card > p {
            margin-bottom: 28px;
            color: #a1a1aa;
            font-size: 14px;
            text-align: center;
        }

        .campo-login {
            margin-bottom: 18px;
        }

        .campo-login label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .campo-login input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #333;
            border-radius: 8px;
            outline: none;
            background: #101010;
            color: #fff;
            font-size: 15px;
            transition: .2s;
        }

        .campo-login input:focus {
            border-color: #ff1a1a;
            box-shadow: 0 0 8px rgba(255, 0, 0, .3);
        }

        .login-opcoes {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 4px 0 25px;
            color: #a1a1aa;
            font-size: 13px;
        }

        .lembrar-login {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .lembrar-login input {
            accent-color: #ff1a1a;
        }

        .login-opcoes a {
            color: #ff1a1a;
            text-decoration: none;
        }

        .login-opcoes a:hover {
            text-decoration: underline;
        }

        .botao-login {
            width: 100%;
            padding: 14px;
            border: 1px solid #ff1a1a;
            border-radius: 7px;
            background: linear-gradient(45deg, #b30000, #ff1a1a);
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: .25s;
        }

        .botao-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 0 10px #ff1a1a, 0 0 25px rgba(255, 0, 0, .45);
        }

        .mensagem-erro {
            margin-bottom: 20px;
            padding: 11px 14px;
            border: 1px solid #ff1a1a;
            border-radius: 7px;
            background: #260000;
            color: #ffb3b3;
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 0 15px;
            }

            .sidebar {
                width: 80%;
                max-width: 280px;
            }

            .login-area {
                align-items: flex-start;
                padding: 35px 15px;
            }

            .login-card {
                padding: 28px 22px;
            }

            .login-opcoes {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="left-area">
            <button class="menu-icon" type="button" onclick="toggleMenu()" aria-label="Abrir menu">☰</button>
            <div class="logo">Agenda Logo!</div>
        </div>
    </header>

    <nav class="sidebar" id="sidebar" aria-label="Menu principal">
        <a href="index.php#">Planos Mensais</a>
        <a href="index.php#">Quem Somos?</a>
        <a href="index.php#">Endereço</a>
        <a href="index.php#">Fale conosco</a>
        <a class="sidebar-login" href="login.php">Login</a>
    </nav>

    <main class="login-area">
        <section class="login-card" aria-labelledby="titulo-login">
            <h1 id="titulo-login">Entrar</h1>
            <p>Acesse sua conta para gerenciar sua barbearia.</p>

            <?php if ($mensagemErro === 'credenciais'): ?>
                <p class="mensagem-erro" role="alert">Login ou senha incorretos.</p>
            <?php elseif ($mensagemErro === 'acesso'): ?>
                <p class="mensagem-erro" role="alert">Acesse sua conta para continuar.</p>
            <?php endif; ?>

            <form action="autenticar.php" method="post">
                <div class="campo-login">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" autocomplete="username" maxlength="60" required>
                </div>

                <div class="campo-login">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" autocomplete="current-password" required>
                </div>

                <div class="login-opcoes">
                    <label class="lembrar-login">
                        <input type="checkbox" name="lembrar">
                        Lembrar de mim
                    </label>
                    <a href="#">Esqueci minha senha</a>
                </div>

                <button class="botao-login" type="submit">Entrar</button>
            </form>
        </section>
    </main>

    <script>
        function toggleMenu() {
            document.getElementById('sidebar').classList.toggle('aberta');
        }
    </script>
</body>
</html>
