<section class="painel-servicos" id="painelServicos">

    <div class="painel-header">
        <h2>Serviços e Preços</h2>

        <p>
            Cadastre e gerencie os serviços oferecidos pela sua barbearia.
        </p>
    </div>

    <div id="mensagemServico" class="mensagem-servico"></div>

    <div class="cadastro-servico">

        <h3 id="tituloFormularioServico">
            Cadastrar novo serviço
        </h3>

        <form
            class="form-servico"
            id="formServico"
            onsubmit="salvarServico(event)"
        >

            <input type="hidden" id="idServico" value="">

            <div class="campo-form">
                <label for="nomeServico">
                    Nome do serviço
                </label>

                <input
                    type="text"
                    id="nomeServico"
                    placeholder="Ex: Corte Masculino"
                    maxlength="80"
                    required
                >
            </div>

            <div class="campo-form">
                <label for="precoServico">
                    Preço
                </label>

                <input
                    type="number"
                    id="precoServico"
                    placeholder="0,00"
                    min="0"
                    step="0.01"
                    required
                >
            </div>

            <div class="campo-form">
                <label for="duracaoServico">
                    Duração (minutos)
                </label>

                <input
                    type="number"
                    id="duracaoServico"
                    placeholder="30"
                    min="5"
                    step="5"
                    required
                >
            </div>

            <div class="botoes-form-servico">

                <button
                    type="submit"
                    class="botao-salvar-servico"
                    id="botaoSalvarServico"
                >
                    Cadastrar
                </button>

                <button
                    type="button"
                    class="botao-cancelar-servico"
                    id="botaoCancelarServico"
                    onclick="cancelarEdicaoServico()"
                    style="display:none;"
                >
                    Cancelar
                </button>

            </div>

        </form>

    </div>

    <div class="lista-servicos" id="listaServicos">
        <p class="carregando-servicos">
            Carregando serviços...
        </p>
    </div>

</section>

<style>

.painel-servicos {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto 60px;
    padding: 30px 0;
}

.painel-header {
    text-align: center;
    margin-bottom: 30px;
}

.painel-header h2 {
    font-size: 28px;
    font-weight: 500;
}

.painel-header p {
    color: #a1a1aa;
    margin-top: 8px;
    font-size: 14px;
}

.mensagem-servico {
    display: none;
    margin-bottom: 20px;
    padding: 12px 16px;
    border-radius: 8px;
    text-align: center;
    font-size: 14px;
}

.mensagem-servico.sucesso {
    display: block;
    border: 1px solid #248a3d;
    background: #092411;
    color: #b9f6c8;
}

.mensagem-servico.erro {
    display: block;
    border: 1px solid #ff1a1a;
    background: #260000;
    color: #ffb3b3;
}

.cadastro-servico {
    background: #080808;
    border: 1px solid #292929;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
}

.cadastro-servico h3 {
    margin-bottom: 20px;
    font-weight: 500;
}

.form-servico {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 12px;
    align-items: end;
}

.campo-form label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    color: #ccc;
}

.campo-form input {
    width: 100%;
    padding: 12px;
    background: #111;
    border: 1px solid #333;
    border-radius: 7px;
    color: #fff;
    outline: none;
}

.campo-form input:focus {
    border-color: #ff1a1a;
    box-shadow: 0 0 8px rgba(255,0,0,.3);
}

.botoes-form-servico {
    display: flex;
    gap: 8px;
}

.botao-salvar-servico,
.botao-cancelar-servico {
    padding: 12px 20px;
    border-radius: 7px;
    cursor: pointer;
    font-weight: 500;
    white-space: nowrap;
}

.botao-salvar-servico {
    border: 1px solid #ff1a1a;
    background: #ff1a1a;
    color: #fff;
}

.botao-salvar-servico:hover {
    background: #d90000;
}

.botao-cancelar-servico {
    border: 1px solid #333;
    background: #151515;
    color: #fff;
}

.botao-cancelar-servico:hover {
    border-color: #ff1a1a;
    color: #ff1a1a;
}

.lista-servicos {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.servico-admin {
    background: #080808;
    border: 1px solid #292929;
    border-radius: 12px;
    padding: 20px;
    transition: .2s;
}

.servico-admin:hover {
    border-color: #ff1a1a;
    transform: translateY(-2px);
}

.servico-admin h4 {
    font-size: 18px;
    margin-bottom: 8px;
}

.servico-admin-preco {
    color: #ff1a1a;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 5px;
}

.servico-admin-duracao {
    color: #a1a1aa;
    font-size: 13px;
    margin-bottom: 18px;
}

.acoes-servico {
    display: flex;
    gap: 8px;
}

.acoes-servico button {
    flex: 1;
    padding: 9px;
    border-radius: 6px;
    cursor: pointer;
    border: 1px solid #333;
    background: #151515;
    color: #fff;
}

.acoes-servico .editar:hover {
    border-color: #fff;
}

.acoes-servico .excluir:hover {
    border-color: #ff1a1a;
    color: #ff1a1a;
}

.carregando-servicos,
.sem-servicos {
    grid-column: 1 / -1;
    padding: 40px;
    text-align: center;
    color: #a1a1aa;
}

@media (max-width: 800px) {

    .form-servico {
        grid-template-columns: 1fr;
    }

    .botoes-form-servico {
        width: 100%;
    }

    .botao-salvar-servico,
    .botao-cancelar-servico {
        flex: 1;
    }

    .lista-servicos {
        grid-template-columns: 1fr;
    }
}

</style>

<script>

let editandoServico = false;

function mostrarMensagemServico(mensagem, tipo) {

    const elemento = document.getElementById('mensagemServico');

    elemento.textContent = mensagem;

    elemento.className = 'mensagem-servico ' + tipo;

    window.setTimeout(function () {
        elemento.className = 'mensagem-servico';
        elemento.textContent = '';
    }, 3000);
}


function carregarServicos() {

    const lista = document.getElementById('listaServicos');

    lista.innerHTML = `
        <p class="carregando-servicos">
            Carregando serviços...
        </p>
    `;

    fetch('gerenciar_servico.php?acao=listar', {
        cache: 'no-store'
    })
    .then(function (resposta) {

        if (!resposta.ok) {
            throw new Error('Erro ao buscar serviços.');
        }

        return resposta.json();
    })
    .then(function (dados) {

        if (!dados.sucesso) {
            throw new Error(dados.mensagem || 'Erro ao buscar serviços.');
        }

        renderizarServicos(dados.servicos);
    })
    .catch(function (erro) {

        lista.innerHTML = `
            <p class="sem-servicos">
                Não foi possível carregar os serviços.
            </p>
        `;

        mostrarMensagemServico(
            erro.message,
            'erro'
        );
    });
}


function renderizarServicos(servicos) {

    const lista = document.getElementById('listaServicos');

    if (!servicos.length) {

        lista.innerHTML = `
            <p class="sem-servicos">
                Nenhum serviço cadastrado.
            </p>
        `;

        return;
    }

    lista.innerHTML = servicos.map(function (servico) {

        const preco = Number(servico.preco)
            .toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

        return `
            <div class="servico-admin">

                <h4>
                    ${escaparHtmlServico(servico.nome)}
                </h4>

                <div class="servico-admin-preco">
                    ${preco}
                </div>

                <div class="servico-admin-duracao">
                    ${servico.duracao} minutos
                </div>

                <div class="acoes-servico">

                    <button
                        type="button"
                        class="editar"
                        onclick="editarServico(
                            ${servico.id},
                            '${escaparJsServico(servico.nome)}',
                            '${servico.preco}',
                            ${servico.duracao}
                        )"
                    >
                        Editar
                    </button>

                    <button
                        type="button"
                        class="excluir"
                        onclick="excluirServico(${servico.id})"
                    >
                        Excluir
                    </button>

                </div>

            </div>
        `;

    }).join('');
}


function escaparHtmlServico(valor) {

    return String(valor).replace(/[&<>"']/g, function (caractere) {

        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[caractere];

    });

}


function escaparJsServico(valor) {

    return String(valor)
        .replace(/\\/g, '\\\\')
        .replace(/'/g, "\\'")
        .replace(/\n/g, '\\n')
        .replace(/\r/g, '\\r');

}


function salvarServico(event) {

    event.preventDefault();

    const id = document.getElementById('idServico').value;
    const nome = document.getElementById('nomeServico').value.trim();
    const preco = document.getElementById('precoServico').value;
    const duracao = document.getElementById('duracaoServico').value;

    if (!nome || !preco || !duracao) {
        mostrarMensagemServico(
            'Preencha todos os campos.',
            'erro'
        );
        return;
    }

    const dados = new URLSearchParams();

    dados.append('acao', id ? 'editar' : 'criar');

    if (id) {
        dados.append('id', id);
    }

    dados.append('nome', nome);
    dados.append('preco', preco);
    dados.append('duracao', duracao);

    const botao = document.getElementById('botaoSalvarServico');

    botao.disabled = true;
    botao.textContent = 'Salvando...';

    fetch('gerenciar_servico.php', {

        method: 'POST',

        headers: {
            'Content-Type':
                'application/x-www-form-urlencoded'
        },

        body: dados.toString()

    })
    .then(function (resposta) {

        return resposta.json();

    })
    .then(function (dados) {

        if (!dados.sucesso) {
            throw new Error(
                dados.mensagem ||
                'Não foi possível salvar o serviço.'
            );
        }

        mostrarMensagemServico(
            dados.mensagem,
            'sucesso'
        );

        cancelarEdicaoServico();

        carregarServicos();

    })
    .catch(function (erro) {

        mostrarMensagemServico(
            erro.message,
            'erro'
        );

    })
    .finally(function () {

        botao.disabled = false;

        botao.textContent =
            editandoServico
                ? 'Salvar alterações'
                : 'Cadastrar';

    });

}


function editarServico(
    id,
    nome,
    preco,
    duracao
) {

    editandoServico = true;

    document.getElementById('idServico').value = id;

    document.getElementById('nomeServico').value = nome;

    document.getElementById('precoServico').value = preco;

    document.getElementById('duracaoServico').value = duracao;

    document.getElementById(
        'tituloFormularioServico'
    ).textContent = 'Editar serviço';

    document.getElementById(
        'botaoSalvarServico'
    ).textContent = 'Salvar alterações';

    document.getElementById(
        'botaoCancelarServico'
    ).style.display = 'block';

    document.getElementById(
        'nomeServico'
    ).focus();

}


function cancelarEdicaoServico() {

    editandoServico = false;

    document.getElementById(
        'formServico'
    ).reset();

    document.getElementById(
        'idServico'
    ).value = '';

    document.getElementById(
        'tituloFormularioServico'
    ).textContent = 'Cadastrar novo serviço';

    document.getElementById(
        'botaoSalvarServico'
    ).textContent = 'Cadastrar';

    document.getElementById(
        'botaoCancelarServico'
    ).style.display = 'none';

}


function excluirServico(id) {

    if (!confirm(
        'Tem certeza que deseja excluir este serviço?'
    )) {
        return;
    }

    const dados = new URLSearchParams();

    dados.append('acao', 'excluir');
    dados.append('id', id);

    fetch('gerenciar_servico.php', {

        method: 'POST',

        headers: {
            'Content-Type':
                'application/x-www-form-urlencoded'
        },

        body: dados.toString()

    })
    .then(function (resposta) {

        return resposta.json();

    })
    .then(function (dados) {

        if (!dados.sucesso) {
            throw new Error(
                dados.mensagem ||
                'Não foi possível excluir o serviço.'
            );
        }

        mostrarMensagemServico(
            dados.mensagem,
            'sucesso'
        );

        carregarServicos();

    })
    .catch(function (erro) {

        mostrarMensagemServico(
            erro.message,
            'erro'
        );

    });

}


carregarServicos();

</script>