<?php
declare(strict_types=1);

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

if (empty($_SESSION['usuario_id'])) {
    header('Location: login.php?erro=acesso');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: painel.php');
    exit;
}

if (!hash_equals($_SESSION['csrf_token'] ?? '', (string) ($_POST['csrf_token'] ?? ''))) {
    header('Location: painel.php?mensagem=erro');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);
$acao = $_POST['acao'] ?? '';

if (!$id || !in_array($acao, ['confirmar', 'editar', 'excluir'], true)) {
    header('Location: painel.php?mensagem=erro');
    exit;
}

require 'conexao.php';

if ($acao === 'confirmar') {
    $comando = $pdo->prepare('UPDATE agendamentos SET confirmado = 1 WHERE id = ?');
    $comando->execute([$id]);
    $mensagem = 'confirmado';
}

if ($acao === 'editar') {
    $horario = trim((string) ($_POST['horario'] ?? ''));

    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario)) {
        header('Location: painel.php?mensagem=horario_invalido');
        exit;
    }

    $comando = $pdo->prepare('UPDATE agendamentos SET horario = ? WHERE id = ?');
    $comando->execute([$horario, $id]);
    $mensagem = 'editado';
}

if ($acao === 'excluir') {
    $comando = $pdo->prepare('DELETE FROM agendamentos WHERE id = ?');
    $comando->execute([$id]);
    $mensagem = 'excluido';
}

header('Location: painel.php?mensagem=' . $mensagem);
exit;
