<?php

$host = "localhost";
$banco = "barbearia";
$usuario = "root";
$senha = "@Xmalinhax1";


try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8",
        $usuario,
        $senha
    );


    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


} catch(PDOException $e){

    echo json_encode([
        "erro"=>$e->getMessage()
    ]);

}

?>