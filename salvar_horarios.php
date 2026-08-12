<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

try {

    $funcionarioId =
        (int)($dados["funcionario_id"] ?? 0);

    $horarios =
        $dados["horarios"] ?? [];

    if ($funcionarioId <= 0) {

        throw new Exception(
            "Funcionário inválido."
        );
    }

    $stmt = $pdo->prepare("
        SELECT id
        FROM funcionarios
        WHERE id = ?
    ");

    $stmt->execute([
        $funcionarioId
    ]);

    if (!$stmt->fetch()) {

        throw new Exception(
            "Funcionário não encontrado."
        );
    }

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        DELETE FROM horarios_funcionarios
        WHERE funcionario_id = ?
    ");

    $stmt->execute([
        $funcionarioId
    ]);

    $stmtInsert = $pdo->prepare("
        INSERT INTO horarios_funcionarios
        (
            funcionario_id,
            dia_semana,
            hora_inicio,
            hora_fim,
            intervalo_inicio,
            intervalo_fim,
            passo_minutos,
            ativo
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            1
        )
    ");

    foreach ($horarios as $horario) {

        if (empty($horario["ativo"])) {
            continue;
        }

        $dia =
            (int)$horario["dia_semana"];

        $inicio =
            $horario["hora_inicio"] ?? "";

        $fim =
            $horario["hora_fim"] ?? "";

        $intervaloInicio =
            !empty($horario["intervalo_inicio"])
                ? $horario["intervalo_inicio"]
                : null;

        $intervaloFim =
            !empty($horario["intervalo_fim"])
                ? $horario["intervalo_fim"]
                : null;

        $passo =
            (int)($horario["passo_minutos"] ?? 30);

        if (
            $dia < 0 ||
            $dia > 6 ||
            empty($inicio) ||
            empty($fim)
        ) {
            continue;
        }

        if ($passo < 5) {
            $passo = 30;
        }

        $stmtInsert->execute([
            $funcionarioId,
            $dia,
            $inicio,
            $fim,
            $intervaloInicio,
            $intervaloFim,
            $passo
        ]);
    }

    $pdo->commit();

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Horários salvos com sucesso."
    ]);

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => $e->getMessage()
    ]);
}