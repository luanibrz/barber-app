<?php

include "conexao.php";


header("Content-Type: application/json");


$telefone = $_GET["telefone"] ?? "";


$telefone = preg_replace(
    "/\D/",
    "",
    $telefone
);



if(strlen($telefone) != 11){

    echo json_encode([

        "sucesso"=>false,

        "mensagem"=>"Telefone inválido."

    ]);

    exit;

}



$sql = $pdo->prepare("

SELECT 
    id,
    nome,
    telefone,
    servico,
    valor,
    profissional,
    data_agendamento,
    horario

FROM agendamentos

WHERE telefone = ?

ORDER BY id DESC

LIMIT 1

");



$sql->execute([

    $telefone

]);



$agendamento = $sql->fetch(PDO::FETCH_ASSOC);



if($agendamento){


    echo json_encode([

        "sucesso"=>true,

        "dados"=>$agendamento

    ]);


}else{


    echo json_encode([

        "sucesso"=>false,

        "mensagem"=>"Nenhum agendamento encontrado para este telefone."

    ]);

}


?>