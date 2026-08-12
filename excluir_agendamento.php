<?php

header("Content-Type: application/json");

include "conexao.php";


/* =====================================================
   RECEBER DADOS
===================================================== */

$dados = json_decode(
    file_get_contents("php://input"),
    true
);



/* =====================================================
   VALIDAR ID
===================================================== */

if (
    !isset($dados["id"]) ||
    !is_numeric($dados["id"])
) {

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "ID do agendamento inválido."

    ]);

    exit;

}



$id = intval($dados["id"]);



if ($id <= 0) {

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "ID do agendamento inválido."

    ]);

    exit;

}



/* =====================================================
   EXCLUIR AGENDAMENTO
===================================================== */

$sql = $pdo->prepare("

    DELETE FROM agendamentos

    WHERE id = ?

");



$sql->execute([

    $id

]);



/* =====================================================
   VERIFICAR SE REALMENTE EXCLUIU
===================================================== */

if ($sql->rowCount() > 0) {

    echo json_encode([

        "sucesso" => true,

        "mensagem" => "Agendamento desmarcado com sucesso."

    ]);

}

else {

    echo json_encode([

        "sucesso" => false,

        "mensagem" => "Agendamento não encontrado ou já foi desmarcado."

    ]);

}

?>