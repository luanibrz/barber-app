<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

try {

    $id = !empty($dados["id"])
        ? (int)$dados["id"]
        : 0;

    $nome = trim($dados["nome"] ?? "");

    $foto = trim($dados["foto"] ?? "");

    $ativo = isset($dados["ativo"])
        ? (int)$dados["ativo"]
        : 1;

    if (strlen($nome) < 2) {

        throw new Exception(
            "Informe um nome válido."
        );
    }

    $ativo = $ativo ? 1 : 0;

    if ($id > 0) {

        $stmt = $pdo->prepare("
            UPDATE funcionarios
            SET
                nome = ?,
                foto = ?,
                ativo = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $nome,
            $foto ?: null,
            $ativo,
            $id
        ]);

    } else {

        $stmt = $pdo->prepare("
            INSERT INTO funcionarios
            (
                nome,
                foto,
                ativo
            )
            VALUES
            (
                ?,
                ?,
                ?
            )
        ");

        $stmt->execute([
            $nome,
            $foto ?: null,
            $ativo
        ]);

        $id = $pdo->lastInsertId();
    }

    echo json_encode([
        "sucesso" => true,
        "id" => $id,
        "mensagem" => "Funcionário salvo com sucesso."
    ]);

} catch (Exception $e) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => $e->getMessage()
    ]);
}