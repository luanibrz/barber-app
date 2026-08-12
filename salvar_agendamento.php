<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

try {

    $nome = trim($dados["nome"] ?? "");
    $telefone = trim($dados["telefone"] ?? "");
    $servico = trim($dados["servico"] ?? "");
    $valor = $dados["valor"] ?? 0;

    $profissional = trim(
        $dados["profissional"] ?? ""
    );

    $profissionalId =
        (int)($dados["profissional_id"] ?? 0);

    $horario = trim(
        $dados["horario"] ?? ""
    );

    $data = trim(
        $dados["data"] ?? ""
    );

    $duracao =
        (int)($dados["duracao"] ?? 30);

    if ($duracao <= 0) {
        $duracao = 30;
    }


    if ($profissionalId <= 0) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" =>
                "Profissional inválido."
        ]);

        exit;
    }


    /*
     * Confirma que o funcionário está ativo
     */

    $stmt = $pdo->prepare("
        SELECT id, nome
        FROM funcionarios
        WHERE id = ?
        AND ativo = 1
        LIMIT 1
    ");

    $stmt->execute([
        $profissionalId
    ]);

    $funcionario =
        $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$funcionario) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" =>
                "Este profissional não está disponível."
        ]);

        exit;
    }


    /*
     * Verifica se o horário já foi ocupado
     */

    $stmt = $pdo->prepare("
        SELECT id
        FROM agendamentos
        WHERE profissional_id = ?
        AND data_agendamento = ?
        AND horario = ?
        LIMIT 1
    ");

    $stmt->execute([
        $profissionalId,
        $data,
        $horario
    ]);


    if ($stmt->fetch()) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" =>
                "Este horário acabou de ser agendado por outro cliente."
        ]);

        exit;
    }


    /*
     * Salva o agendamento
     */

    $sql = $pdo->prepare("
        INSERT INTO agendamentos
        (
            nome,
            telefone,
            servico,
            valor,
            profissional,
            profissional_id,
            horario,
            duracao,
            data_agendamento
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
            ?,
            ?
        )
    ");


    $sql->execute([

        $nome,

        $telefone,

        $servico,

        $valor,

        $funcionario["nome"],

        $profissionalId,

        $horario,

        $duracao,

        $data

    ]);


    echo json_encode([

        "sucesso" => true,

        "id" =>
            $pdo->lastInsertId()

    ]);


} catch (PDOException $e) {

    echo json_encode([

        "sucesso" => false,

        "mensagem" =>
            $e->getMessage()

    ]);
}
?>