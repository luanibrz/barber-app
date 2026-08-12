<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Funcionários - BarberPro</title>

<style>

    .excluir {
    background: #8b0000;
    color: #fff;
}

.excluir:hover {
    background: #c00000;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 30px;
    background: #050505;
    color: #fff;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 1100px;
    margin: auto;
}

h1 {
    color: #ff1a1a;
}

.topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

a,
button {
    border: 0;
    border-radius: 7px;
    padding: 11px 16px;
    cursor: pointer;
}



.formulario,
.funcionario {
    background: #111;
    border: 1px solid #292929;
    border-radius: 12px;
    padding: 22px;
    margin-bottom: 20px;
}

.campo {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 6px;
}

input,
select {
    width: 100%;
    padding: 11px;
    border-radius: 7px;
    border: 1px solid #444;
    background: #050505;
    color: #fff;
}

.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.dia {
    border: 1px solid #333;
    padding: 15px;
    border-radius: 10px;
    margin-top: 12px;
}

.dia-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.dia-header input {
    width: auto;
}

.dia-campos {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.acoes {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
}

.salvar {
    background: #e60000;
    color: #fff;
}

.editar {
    background: #fff;
    color: #000;
}

.status {
    background: #222;
    color: #fff;
}

.ativo {
    color: #00e676;
}

.inativo {
    color: #ff4444;
}

@media(max-width:700px) {

    .grid,
    .dia-campos {
        grid-template-columns: 1fr;
    }

    .topo {
        flex-direction: column;
        align-items: flex-start;
    }
}

</style>

</head>

<body>

<div class="container">

    <div class="topo">

    <div>

        <h1>Funcionários</h1>

        <p>
            Cadastre profissionais e configure os horários de trabalho.
        </p>

    </div>

</div>


    <div class="formulario">

        <h2 id="tituloFuncionario">
            Novo funcionário
        </h2>

        <input
            type="hidden"
            id="funcionarioId"
        >

        <div class="grid">

            <div class="campo">

                <label>Nome</label>

                <input
                    id="funcionarioNome"
                    type="text"
                    maxlength="100"
                    placeholder="Ex: João"
                >

            </div>

            <div class="campo">

                <label>URL da foto</label>

                <input
                    id="funcionarioFoto"
                    type="text"
                    placeholder="https://..."
                >

            </div>

        </div>


        <div class="campo">

            <label>

                <input
                    type="checkbox"
                    id="funcionarioAtivo"
                    checked
                >

                Funcionário disponível para agendamento

            </label>

        </div>


        <h3>Horários de trabalho</h3>

        <div id="horariosForm"></div>


        <div class="acoes">

            <button
                class="salvar"
                onclick="salvarTudo()"
            >
                Salvar funcionário
            </button>

            <button
                class="status"
                onclick="limparFormulario()"
            >
                Novo / Limpar
            </button>

        </div>

    </div>


    <h2>Profissionais cadastrados</h2>

    <div id="listaFuncionarios"></div>

</div>


<script>

const dias = [
    "Domingo",
    "Segunda-feira",
    "Terça-feira",
    "Quarta-feira",
    "Quinta-feira",
    "Sexta-feira",
    "Sábado"
];


let funcionarios = [];


function criarFormularioHorarios() {

    const container =
        document.getElementById(
            "horariosForm"
        );

    container.innerHTML = "";


    dias.forEach(function(nome, index) {

        container.innerHTML += `

            <div class="dia">

                <div class="dia-header">

                    <input
                        type="checkbox"
                        id="dia_${index}"
                    >

                    <strong>
                        ${nome}
                    </strong>

                </div>

                <div class="dia-campos">

                    <div>

                        <label>Início</label>

                        <input
                            type="time"
                            id="inicio_${index}"
                            value="08:00"
                        >

                    </div>

                    <div>

                        <label>Fim</label>

                        <input
                            type="time"
                            id="fim_${index}"
                            value="18:00"
                        >

                    </div>

                    <div>

                        <label>Intervalo início</label>

                        <input
                            type="time"
                            id="intervaloInicio_${index}"
                        >

                    </div>

                    <div>

                        <label>Intervalo fim</label>

                        <input
                            type="time"
                            id="intervaloFim_${index}"
                        >

                    </div>

                </div>

                <div style="margin-top:10px">

                    <label>
                        Intervalo entre horários
                    </label>

                    <select id="passo_${index}">

                        <option value="15">15 minutos</option>

                        <option
                            value="30"
                            selected
                        >
                            30 minutos
                        </option>

                        <option value="45">45 minutos</option>

                        <option value="60">60 minutos</option>

                    </select>

                </div>

            </div>

        `;

    });
}


async function carregarFuncionarios() {

    const resposta =
        await fetch(
            "listar_funcionarios.php?todos=1"
        );

    const dados =
        await resposta.json();

    if (!dados.sucesso) {

        alert(
            dados.mensagem
        );

        return;
    }

    funcionarios =
        dados.funcionarios;

    renderizarFuncionarios();
}


function renderizarFuncionarios() {

    const lista =
        document.getElementById(
            "listaFuncionarios"
        );

    lista.innerHTML = "";


    funcionarios.forEach(function(funcionario) {

        const div =
            document.createElement("div");

        div.className =
            "funcionario";


        const status =
            Number(funcionario.ativo) === 1
                ? `<span class="ativo">● Ativo</span>`
                : `<span class="inativo">● Inativo</span>`;


        div.innerHTML = `

            <h3>
                ${escapar(funcionario.nome)}
            </h3>

            <p>
                ${status}
            </p>

            <div class="acoes">

    <button
        class="editar"
        onclick="editarFuncionario(${funcionario.id})"
    >
        ✏️ Editar
    </button>

    <button
        class="status"
        onclick="alternarStatus(${funcionario.id})"
    >
        ${
            Number(funcionario.ativo) === 1
            ? "🔴 Desativar"
            : "🟢 Ativar"
        }
    </button>

    <button
        class="excluir"
        onclick="excluirFuncionario(${funcionario.id})"
    >
        🗑️ Excluir
    </button>

</div>
        `;

        lista.appendChild(div);

    });
}


function editarFuncionario(id) {

    const funcionario =
        funcionarios.find(
            f => Number(f.id) === Number(id)
        );

    if (!funcionario) {
        return;
    }


    document.getElementById(
        "funcionarioId"
    ).value =
        funcionario.id;


    document.getElementById(
        "funcionarioNome"
    ).value =
        funcionario.nome;


    document.getElementById(
        "funcionarioFoto"
    ).value =
        funcionario.foto || "";


    document.getElementById(
        "funcionarioAtivo"
    ).checked =
        Number(funcionario.ativo) === 1;


    dias.forEach(function(_, index) {

        document.getElementById(
            "dia_" + index
        ).checked = false;

    });


    (funcionario.horarios || [])
        .forEach(function(horario) {

            const dia =
                Number(horario.dia_semana);

            document.getElementById(
                "dia_" + dia
            ).checked =
                Number(horario.ativo) === 1;

            document.getElementById(
                "inicio_" + dia
            ).value =
                horario.hora_inicio
                    .substring(0, 5);

            document.getElementById(
                "fim_" + dia
            ).value =
                horario.hora_fim
                    .substring(0, 5);

            document.getElementById(
                "intervaloInicio_" + dia
            ).value =
                horario.intervalo_inicio
                    ? horario.intervalo_inicio.substring(0, 5)
                    : "";

            document.getElementById(
                "intervaloFim_" + dia
            ).value =
                horario.intervalo_fim
                    ? horario.intervalo_fim.substring(0, 5)
                    : "";

            document.getElementById(
                "passo_" + dia
            ).value =
                horario.passo_minutos || 30;

        });


    document.getElementById(
        "tituloFuncionario"
    ).textContent =
        "Editar funcionário";

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}


async function salvarTudo() {

    const id =
        document.getElementById(
            "funcionarioId"
        ).value;


    const nome =
        document.getElementById(
            "funcionarioNome"
        ).value.trim();


    const foto =
        document.getElementById(
            "funcionarioFoto"
        ).value.trim();


    const ativo =
        document.getElementById(
            "funcionarioAtivo"
        ).checked
            ? 1
            : 0;


    if (nome.length < 2) {

        alert(
            "Informe o nome do funcionário."
        );

        return;
    }


    const respostaFuncionario =
        await fetch(
            "salvar_funcionario.php",
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/json"
                },

                body: JSON.stringify({

                    id: id || null,

                    nome: nome,

                    foto: foto,

                    ativo: ativo

                })
            }
        );


    const resultadoFuncionario =
        await respostaFuncionario.json();


    if (!resultadoFuncionario.sucesso) {

        alert(
            resultadoFuncionario.mensagem
        );

        return;
    }


    const funcionarioId =
        resultadoFuncionario.id;


    const horarios = [];


    dias.forEach(function(_, index) {

        horarios.push({

            dia_semana: index,

            ativo:
                document.getElementById(
                    "dia_" + index
                ).checked
                    ? 1
                    : 0,

            hora_inicio:
                document.getElementById(
                    "inicio_" + index
                ).value,

            hora_fim:
                document.getElementById(
                    "fim_" + index
                ).value,

            intervalo_inicio:
                document.getElementById(
                    "intervaloInicio_" + index
                ).value,

            intervalo_fim:
                document.getElementById(
                    "intervaloFim_" + index
                ).value,

            passo_minutos:
                Number(
                    document.getElementById(
                        "passo_" + index
                    ).value
                )

        });

    });


    const respostaHorarios =
        await fetch(
            "salvar_horarios.php",
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/json"
                },

                body: JSON.stringify({

                    funcionario_id:
                        funcionarioId,

                    horarios:
                        horarios

                })
            }
        );


    const resultadoHorarios =
        await respostaHorarios.json();


    if (!resultadoHorarios.sucesso) {

        alert(
            resultadoHorarios.mensagem
        );

        return;
    }


    alert(
        "Funcionário e horários salvos com sucesso!"
    );


    limparFormulario();

    carregarFuncionarios();
}


async function alternarStatus(id) {

    const funcionario =
        funcionarios.find(
            f => Number(f.id) === Number(id)
        );

    if (!funcionario) {
        return;
    }


    const novoStatus =
        Number(funcionario.ativo) === 1
            ? 0
            : 1;


    const resposta =
        await fetch(
            "salvar_funcionario.php",
            {
                method: "POST",

                headers: {
                    "Content-Type":
                        "application/json"
                },

                body: JSON.stringify({

                    id: funcionario.id,

                    nome: funcionario.nome,

                    foto: funcionario.foto || "",

                    ativo: novoStatus

                })
            }
        );


    const resultado =
        await resposta.json();


    if (!resultado.sucesso) {

        alert(
            resultado.mensagem
        );

        return;
    }


    carregarFuncionarios();
}


function limparFormulario() {

    document.getElementById(
        "funcionarioId"
    ).value = "";


    document.getElementById(
        "funcionarioNome"
    ).value = "";


    document.getElementById(
        "funcionarioFoto"
    ).value = "";


    document.getElementById(
        "funcionarioAtivo"
    ).checked = true;


    document.getElementById(
        "tituloFuncionario"
    ).textContent =
        "Novo funcionário";


    criarFormularioHorarios();
}


function escapar(texto) {

    return String(texto)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}


criarFormularioHorarios();

carregarFuncionarios();


async function excluirFuncionario(id) {

    const funcionario =
        funcionarios.find(
            f => Number(f.id) === Number(id)
        );

    if (!funcionario) {
        alert("Funcionário não encontrado.");
        return;
    }


    const confirmar = confirm(
        "Tem certeza que deseja excluir o funcionário \"" +
        funcionario.nome +
        "\"?\n\n" +
        "Essa ação não poderá ser desfeita."
    );


    if (!confirmar) {
        return;
    }


    try {

        const resposta =
            await fetch(
                "excluir_funcionario.php",
                {
                    method: "POST",

                    headers: {
                        "Content-Type":
                            "application/json"
                    },

                    body: JSON.stringify({
                        id: funcionario.id
                    })
                }
            );


        const resultado =
            await resposta.json();


        if (!resultado.sucesso) {

            alert(
                resultado.mensagem
            );

            return;
        }


        alert(
            resultado.mensagem
        );


        /*
         * Atualiza a lista
         */
        await carregarFuncionarios();


        /*
         * Limpa o formulário caso
         * estivesse editando esse funcionário.
         */
        if (
            Number(
                document.getElementById(
                    "funcionarioId"
                ).value
            ) === Number(id)
        ) {

            limparFormulario();
        }


    } catch (erro) {

        console.error(erro);

        alert(
            "Erro ao excluir funcionário."
        );
    }
}

</script>

</body>
</html>