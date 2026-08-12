<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

$dados = json_decode(
    file_get_contents("php://input"),
    true
);

try {

    $id = (int)($dados["id"] ?? 0);

    if ($id <= 0) {
        throw new Exception("Funcionário inválido.");
    }

    // Verifica se o funcionário existe
    $stmt = $pdo->prepare("
        SELECT id, nome
        FROM funcionarios
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$funcionario) {
        throw new Exception("Funcionário não encontrado.");
    }

    /*
     * Verifica se existem agendamentos
     * associados ao funcionário.
     */
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM agendamentos
        WHERE profissional_id = ?
    ");

    $stmt->execute([$id]);

    $quantidadeAgendamentos =
        (int)$stmt->fetchColumn();


    if ($quantidadeAgendamentos > 0) {

        echo json_encode([
            "sucesso" => false,
            "bloqueado" => true,
            "mensagem" =>
                "Não é possível excluir este funcionário porque existem " .
                $quantidadeAgendamentos .
                " agendamento(s) associado(s) a ele. " .
                "Use a opção Desativar para removê-lo dos novos agendamentos."
        ]);

        exit;
    }


    /*
     * Como horarios_funcionarios possui
     * ON DELETE CASCADE, os horários serão
     * removidos automaticamente.
     */
    $stmt = $pdo->prepare("
        DELETE FROM funcionarios
        WHERE id = ?
    ");

    $stmt->execute([$id]);


    echo json_encode([
        "sucesso" => true,
        "mensagem" =>
            "Funcionário excluído com sucesso."
    ]);


} catch (Exception $e) {

    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => $e->getMessage()
    ]);
}