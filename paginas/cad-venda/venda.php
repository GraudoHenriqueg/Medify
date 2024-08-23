<?php
//Inclui o relatório de usuário
include_once '../../backend/medicamento/buscaMedicamento.php';
include_once '../../backend/venda/relatorioVenda.php';
include_once '../../backend/situacao/buscaSituacao.php';

//Inicializa uma variavel com nome de mensagem com o valor null
$mensagem = null;
//Verificar se recebeu alguma informação por meio de GET
if ($_GET) {
    //Verifica se essa informação é um status
    if ($_GET['status']) {
        //Utiliza a estrutura de decisão switch para verificar qual
        //status foi recebido e atribuir uma mensagem conforme necessário
        switch ($_GET['status']) {
            case 201:
                //Criado
                $mensagem = 'Adicionado com sucesso!';
                break;
            case 400:
                //Bad request
                $mensagem = 'Incerção não funcionou';
                break;
            case 500:
                //Erro no servidor
                $mensagem = 'Erro ao tentar inserir informações';
                break;
        }
    }
}

?>
<html>

<head>
    <title>Venda | Medify</title>
    <link rel="stylesheet" href="venda.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.css">
</head>

<body>
    <?php
    include_once '../../componentes/menu/menu.php';
    ?>
    <section class="pagina">
        <header>
            <h1>Administração | Venda de Medicamento</h1>
        </header>
        <form action="../../backend/venda/criarVenda.php" method="post">
            <div class="inputs">
                <div>
                    <label for="">Data_venda:</label><input type="date" name="dt_venda">
                    <label for="">Método_de_pagamento:</label><input type="text" name="metodo_pagamento">
                    <label for="">Data_pagamento:</label><input type="date" name="dt_pagamento">
                </div>
                <div>
                    <label for="">Cliente:</label><input type="text" name="cliente">
                    <label for="">Tipo:</label><input type="text" name="tipo">
                    <select name="situacao">
                        <option value="">Situação</option>
                        <?php
                        if (isset($arrSituacao)) {
                            foreach ($arrSituacao as $situacao) {
                                echo ("<option value=" . $situacao["id"] . ">" . $situacao["descricao"] . "</option>");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <select name="medicamento">
                        <option value="">Medicamento</option>
                        <?php
                        if (isset($arrMedicamento)) {
                            foreach ($arrMedicamento as $medicamento) {
                                echo ("<option value=" . $medicamento["id"] . ">" . $medicamento["nome"] . "</option>");
                            }
                        }
                        ?>
                    </select>
                    <label>Quantidade:</label><input type="number" name="quantidade">
                </div>





                <div class="controles">
                    <button type="submit" class="salvar">Salvar</button>
                    <button type="reset" class="cancelar">Cancelar</button>

                    <?php
                    echo ('<p>' . $mensagem . '</p>')
                        ?>





                </div>
            </div>

        </form>
        <div class="relatorio">
            <h1>Relatório</h1>
            <table>
                <tr>
                    <th>Ação</th>
                    <th>dt_venda</th>
                    <th>metodo_de_pagamento</th>
                    <th>dt_pagamento</th>
                    <th>cliente</th>
                    <th>tipo</th>
                    <th>situacao</th>
                </tr>
                <?php

                //Utilizar a função foreach
                //para iterar entre os itens do array
                //que é o nosso $relatorio
                
                foreach ($relatorio as $venda) {
                    echo ("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>" . $venda['dt_venda'] . "</td>
                                <td>" . $venda['metodo_de_pagamento'] . "</td>
                                <td>" . $venda['dt_pagamento'] . "</td>
                                <td>" . $venda['cliente'] . "</td>
                                <td>" . $venda['tipo'] . "</td>
                                <td>" . $venda['situacao'] . "</td>
                            </tr>
                        ");
                }

                ?>
            </table>
        </div>
    </section>
</body>

</html>