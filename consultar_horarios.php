<?php

header("Content-Type: application/json; charset=utf-8");

include "conexao.php";

date_default_timezone_set("America/Sao_Paulo");


function erro($mensagem)
{
    http_response_code(400);

    echo json_encode([
        "sucesso" => false,
        "mensagem" => $mensagem,
        "horarios" => []
    ]);

    exit;
}


/*
 * Dados recebidos
 */

$funcionarioId =
    (int)($_GET["profissional_id"] ?? 0);

$dataTexto =
    trim($_GET["data"] ?? "");

$duracao =
    (int)($_GET["duracao"] ?? 30);


if ($funcionarioId <= 0) {
    erro("Profissional inválido.");
}


if ($duracao <= 0) {
    $duracao = 30;
}


/*
 * Converte a data
 *
 * Aceita:
 *
 * 11/08/2026
 *
 * ou
 *
 * 2026-08-11
 */

$data = DateTime::createFromFormat(
    "d/m/Y",
    $dataTexto
);


if (!$data) {

    $data = DateTime::createFromFormat(
        "Y-m-d",
        $dataTexto
    );
}


if (!$data) {
    erro("Data inválida.");
}


/*
 * Formatos utilizados no banco
 */

$dataBanco =
    $data->format("d/m/Y");

$dataBancoAlternativa =
    $data->format("Y-m-d");


/*
 * PHP:
 *
 * Domingo = 0
 * Segunda = 1
 * Terça = 2
 * Quarta = 3
 * Quinta = 4
 * Sexta = 5
 * Sábado = 6
 */

$diaSemana =
    (int)$data->format("w");


try {

    /*
     * =====================================================
     * 1. VERIFICA SE O FUNCIONÁRIO EXISTE E ESTÁ ATIVO
     * =====================================================
     */

    $stmt = $pdo->prepare("
        SELECT
            id,
            nome,
            ativo
        FROM funcionarios
        WHERE id = ?
        LIMIT 1
    ");

    $stmt->execute([
        $funcionarioId
    ]);

    $funcionario =
        $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$funcionario) {

        erro(
            "Funcionário não encontrado."
        );
    }


    if ((int)$funcionario["ativo"] !== 1) {

        echo json_encode([
            "sucesso" => true,
            "funcionario_id" => $funcionarioId,
            "funcionario" => $funcionario["nome"],
            "data" => $dataBanco,
            "horarios" => [],
            "mensagem" =>
                "Este funcionário está indisponível."
        ]);

        exit;
    }


    /*
     * =====================================================
     * 2. BUSCA O HORÁRIO DE TRABALHO DO FUNCIONÁRIO
     * =====================================================
     */

    $stmt = $pdo->prepare("
        SELECT
            hora_inicio,
            hora_fim,
            intervalo_inicio,
            intervalo_fim,
            passo_minutos
        FROM horarios_funcionarios
        WHERE funcionario_id = ?
        AND dia_semana = ?
        AND ativo = 1
        LIMIT 1
    ");

    $stmt->execute([
        $funcionarioId,
        $diaSemana
    ]);

    $agenda =
        $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$agenda) {

        echo json_encode([
            "sucesso" => true,
            "funcionario_id" => $funcionarioId,
            "funcionario" => $funcionario["nome"],
            "data" => $dataBanco,
            "dia_semana" => $diaSemana,
            "horarios" => [],
            "mensagem" =>
                "Este profissional não trabalha neste dia."
        ]);

        exit;
    }


    /*
     * =====================================================
     * 3. PASSO DOS HORÁRIOS
     * =====================================================
     */

    $passo =
        (int)$agenda["passo_minutos"];


    if ($passo <= 0) {
        $passo = 30;
    }


    /*
     * =====================================================
     * 4. BUSCA AGENDAMENTOS JÁ EXISTENTES
     * =====================================================
     */

    $stmt = $pdo->prepare("
        SELECT
            horario,
            duracao
        FROM agendamentos
        WHERE profissional_id = ?
        AND (
            data_agendamento = ?
            OR data_agendamento = ?
        )
    ");

    $stmt->execute([
        $funcionarioId,
        $dataBanco,
        $dataBancoAlternativa
    ]);


    $agendamentos =
        $stmt->fetchAll(PDO::FETCH_ASSOC);


    /*
     * =====================================================
     * 5. FUNÇÃO PARA CONVERTER HH:MM EM MINUTOS
     * =====================================================
     */

    function converterMinutos($hora)
    {
        $partes =
            explode(
                ":",
                substr($hora, 0, 5)
            );

        $horaNumero =
            (int)$partes[0];

        $minutoNumero =
            (int)$partes[1];

        return
            ($horaNumero * 60)
            + $minutoNumero;
    }


    /*
     * =====================================================
     * 6. HORÁRIO DE TRABALHO
     * =====================================================
     */

    $inicio =
        converterMinutos(
            $agenda["hora_inicio"]
        );

    $fim =
        converterMinutos(
            $agenda["hora_fim"]
        );


    /*
     * =====================================================
     * 7. INTERVALO / ALMOÇO
     * =====================================================
     */

    $intervaloInicio = null;
    $intervaloFim = null;


    if (
        !empty($agenda["intervalo_inicio"]) &&
        !empty($agenda["intervalo_fim"])
    ) {

        $intervaloInicio =
            converterMinutos(
                $agenda["intervalo_inicio"]
            );

        $intervaloFim =
            converterMinutos(
                $agenda["intervalo_fim"]
            );
    }


    /*
     * =====================================================
     * 8. HORÁRIO ATUAL
     * =====================================================
     */

    $agora =
        new DateTime();

    $hoje =
        $agora->format("d/m/Y");

    $minutoAtual =
        ((int)$agora->format("H") * 60)
        + (int)$agora->format("i");


    /*
     * =====================================================
     * 9. GERA OS HORÁRIOS
     * =====================================================
     */

    $horariosLivres = [];


    for (
        $slot = $inicio;
        $slot + $duracao <= $fim;
        $slot += $passo
    ) {

        $slotFim =
            $slot + $duracao;


        /*
         * -----------------------------------------------
         * Intervalo / almoço
         * -----------------------------------------------
         */

        if (
            $intervaloInicio !== null &&
            $intervaloFim !== null
        ) {

            if (
                $slot < $intervaloFim &&
                $slotFim > $intervaloInicio
            ) {

                continue;
            }
        }


        /*
         * -----------------------------------------------
         * Horários que já passaram hoje
         * -----------------------------------------------
         */

        if (
            $dataBanco === $hoje &&
            $slot <= $minutoAtual
        ) {

            continue;
        }


        /*
         * -----------------------------------------------
         * Verifica conflito com agendamentos
         * -----------------------------------------------
         */

        $ocupado = false;


        foreach (
            $agendamentos
            as $agendamento
        ) {

            $inicioExistente =
                converterMinutos(
                    $agendamento["horario"]
                );


            $duracaoExistente =
                (int)$agendamento["duracao"];


            if ($duracaoExistente <= 0) {
                $duracaoExistente = 30;
            }


            $fimExistente =
                $inicioExistente
                + $duracaoExistente;


            /*
             * Existe sobreposição?
             */

            if (
                $slot < $fimExistente &&
                $slotFim > $inicioExistente
            ) {

                $ocupado = true;

                break;
            }
        }


        /*
         * -----------------------------------------------
         * Horário livre
         * -----------------------------------------------
         */

        if (!$ocupado) {

            $horariosLivres[] =
                sprintf(
                    "%02d:%02d",
                    floor($slot / 60),
                    $slot % 60
                );
        }
    }


    /*
     * =====================================================
     * 10. RETORNO
     * =====================================================
     */

    echo json_encode([

        "sucesso" => true,

        "funcionario_id" =>
            $funcionarioId,

        "funcionario" =>
            $funcionario["nome"],

        "data" =>
            $dataBanco,

        "dia_semana" =>
            $diaSemana,

        "hora_inicio" =>
            $agenda["hora_inicio"],

        "hora_fim" =>
            $agenda["hora_fim"],

        "passo_minutos" =>
            $passo,

        "horarios" =>
            $horariosLivres
    ]);


} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([

        "sucesso" => false,

        "mensagem" =>
            $e->getMessage(),

        "horarios" => []
    ]);
}