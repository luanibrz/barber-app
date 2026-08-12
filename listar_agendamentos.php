<?php
declare(strict_types=1);

session_start();

header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Não autorizado.']);
    exit;
}

require 'conexao.php';

$consulta = $pdo->query(
    'SELECT id, nome, telefone, servico, profissional, horario, confirmado
     FROM agendamentos
     ORDER BY id DESC'
);

echo json_encode([
    'agendamentos' => $consulta->fetchAll(PDO::FETCH_ASSOC),
]);
