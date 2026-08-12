<?php
declare(strict_types=1);

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

require 'conexao.php';

$login = trim((string) ($_POST['login'] ?? ''));
$senha = (string) ($_POST['senha'] ?? '');

if ($login === '' || $senha === '') {
    header('Location: login.php?erro=credenciais');
    exit;
}

$consulta = $pdo->prepare(
    'SELECT id, nome, login, senha_hash FROM usuarios WHERE login = ? AND ativo = 1 LIMIT 1'
);
$consulta->execute([$login]);
$usuario = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha_hash'])) {
    header('Location: login.php?erro=credenciais');
    exit;
}

session_regenerate_id(true);
$_SESSION['usuario_id'] = (int) $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_login'] = $usuario['login'];

header('Location: painel.php?login=sucesso');
exit;
