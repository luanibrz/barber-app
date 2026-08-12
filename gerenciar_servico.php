<?php

session_start();

header(
    'Content-Type: application/json; charset=utf-8'
);

header(
    'Cache-Control: no-store, no-cache, must-revalidate, max-age=0'
);


function responder(
    array $dados,
    int $status = 200
): void {

    http_response_code($status);

    echo json_encode(
        $dados,
        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_SLASHES
    );

    exit;
}


if (empty($_SESSION['usuario_id'])) {

    responder(
        [
            'sucesso' => false,
            'mensagem' =>
                'Sua sessão expirou. Faça login novamente.'
        ],
        401
    );

}


try {

    require __DIR__ . '/conexao.php';


    if (
        !isset($pdo) ||
        !($pdo instanceof PDO)
    ) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'A conexão com o banco de dados não foi inicializada.'
            ],
            500
        );

    }


    /*
     * Cria a tabela caso ela ainda não exista.
     *
     * Se a tabela já existir, seus dados não serão apagados.
     */

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS servicos (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            nome VARCHAR(80) NOT NULL,
            preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            duracao INT UNSIGNED NOT NULL DEFAULT 30,
            PRIMARY KEY (id)
        )
        ENGINE=InnoDB
        DEFAULT CHARSET=utf8mb4
        COLLATE=utf8mb4_unicode_ci'
    );


} catch (Throwable $e) {

    responder(
        [
            'sucesso' => false,
            'mensagem' =>
                'Não foi possível acessar a tabela de serviços. Verifique a conexão com o banco de dados.'
        ],
        500
    );

}


$acao =
    $_GET['acao']
    ?? $_POST['acao']
    ?? '';


/*
 * LISTAR
 */

if ($acao === 'listar') {

    try {

        $consulta =
            $pdo->query(
                'SELECT id, nome, preco, duracao
                 FROM servicos
                 ORDER BY nome ASC, id ASC'
            );


        responder(
            [
                'sucesso' => true,
                'servicos' =>
                    $consulta->fetchAll(
                        PDO::FETCH_ASSOC
                    )
            ]
        );


    } catch (Throwable $e) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Erro ao buscar os serviços no banco de dados.'
            ],
            500
        );

    }

}


/*
 * CRIAR OU EDITAR
 */

if (
    $acao === 'criar' ||
    $acao === 'editar'
) {

    $id =
        (int) (
            $_POST['id']
            ?? 0
        );


    $nome =
        trim(
            (string) (
                $_POST['nome']
                ?? ''
            )
        );


    $precoBruto =
        trim(
            (string) (
                $_POST['preco']
                ?? ''
            )
        );


    $duracao =
        (int) (
            $_POST['duracao']
            ?? 0
        );


    /*
     * Aceita:
     *
     * 10.50
     * 10,50
     */

    $precoBruto =
        str_replace(
            ',',
            '.',
            $precoBruto
        );


    if ($nome === '') {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Informe o nome do serviço.'
            ],
            400
        );

    }


    if (
        mb_strlen($nome) > 80
    ) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'O nome do serviço deve ter no máximo 80 caracteres.'
            ],
            400
        );

    }


    if (
        $precoBruto === '' ||
        !is_numeric($precoBruto) ||
        (float) $precoBruto < 0
    ) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Informe um preço válido.'
            ],
            400
        );

    }


    if ($duracao < 5) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'A duração deve ser de pelo menos 5 minutos.'
            ],
            400
        );

    }


    $preco =
        number_format(
            (float) $precoBruto,
            2,
            '.',
            ''
        );


    try {

        /*
         * NOVO SERVIÇO
         */

        if ($acao === 'criar') {

            $consulta =
                $pdo->prepare(
                    'INSERT INTO servicos
                    (nome, preco, duracao)
                    VALUES
                    (:nome, :preco, :duracao)'
                );


            $consulta->execute(
                [
                    ':nome' =>
                        $nome,

                    ':preco' =>
                        $preco,

                    ':duracao' =>
                        $duracao
                ]
            );


            responder(
                [
                    'sucesso' => true,
                    'mensagem' =>
                        'Serviço cadastrado com sucesso.',
                    'id' =>
                        (int)
                        $pdo->lastInsertId()
                ]
            );

        }


        /*
         * EDITAR
         */

        if ($id <= 0) {

            responder(
                [
                    'sucesso' => false,
                    'mensagem' =>
                        'Serviço inválido.'
                ],
                400
            );

        }


        $consulta =
            $pdo->prepare(
                'UPDATE servicos
                 SET
                    nome = :nome,
                    preco = :preco,
                    duracao = :duracao
                 WHERE id = :id'
            );


        $consulta->execute(
            [
                ':nome' =>
                    $nome,

                ':preco' =>
                    $preco,

                ':duracao' =>
                    $duracao,

                ':id' =>
                    $id
            ]
        );


        responder(
            [
                'sucesso' => true,
                'mensagem' =>
                    $consulta->rowCount() > 0
                        ? 'Serviço atualizado com sucesso.'
                        : 'Nenhuma alteração foi necessária.'
            ]
        );


    } catch (Throwable $e) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Não foi possível salvar o serviço. Verifique a estrutura da tabela servicos.'
            ],
            500
        );

    }

}


/*
 * EXCLUIR
 */

if ($acao === 'excluir') {

    $id =
        (int) (
            $_POST['id']
            ?? 0
        );


    if ($id <= 0) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Serviço inválido.'
            ],
            400
        );

    }


    try {

        $consulta =
            $pdo->prepare(
                'DELETE FROM servicos
                 WHERE id = :id'
            );


        $consulta->execute(
            [
                ':id' =>
                    $id
            ]
        );


        if (
            $consulta->rowCount() === 0
        ) {

            responder(
                [
                    'sucesso' => false,
                    'mensagem' =>
                        'Serviço não encontrado.'
                ],
                404
            );

        }


        responder(
            [
                'sucesso' => true,
                'mensagem' =>
                    'Serviço excluído com sucesso.'
            ]
        );


    } catch (Throwable $e) {

        responder(
            [
                'sucesso' => false,
                'mensagem' =>
                    'Não foi possível excluir o serviço.'
            ],
            500
        );

    }

}


/*
 * AÇÃO DESCONHECIDA
 */

responder(
    [
        'sucesso' => false,
        'mensagem' =>
            'Ação inválida.'
    ],
    400
);