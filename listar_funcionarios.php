<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

try {

    $todos = isset($_GET["todos"]) && $_GET["todos"] == "1";

    if ($todos) {

        $stmt = $pdo->query("
            SELECT
                id,
                nome,
                foto,
                ativo
            FROM funcionarios
            ORDER BY nome
        ");

    } else {

        $stmt = $pdo->query("
            SELECT
                id,
                nome,
                foto,
                ativo
            FROM funcionarios
            WHERE ativo = 1
            ORDER BY nome
        ");

    }

    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($funcionarios as &$funcionario) {

        $stmtHorario = $pdo->prepare("
            SELECT
                dia_semana,
                hora_inicio,
                hora_fim,
                intervalo_inicio,
                intervalo_fim,
                passo_minutos,
                ativo
            FROM horarios_funcionarios
            WHERE funcionario_id = ?
            ORDER BY dia_semana
        ");

        $stmtHorario->execute([
            $funcionario["id"]
        ]);

        $funcionario["horarios"] =
            $stmtHorario->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode([
        "sucesso" => true,
        "funcionarios" => $funcionarios
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => $e->getMessage()
    ]);
}