<?php
//Inclui o relatório de usuário
include_once '../../backend/medicamento/buscaMedicamento.php';
include_once '../../backend/compra/relatorioCompra.php';
include_once '../../backend/situacao/buscaSituacao.php';

//Inicializa uma variavel com nome de mensagem com o valor null
$mensagem = null;
//Verificar se recebeu alguma informação por meio de GET
if($_GET){
    //Verifica se essa informação é um status
    if($_GET['status']){
        //Utiliza a estrutura de decisão switch para verificar qual
        //status foi recebido e atribuir uma mensagem conforme necessário
        switch($_GET['status']){
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
        <title>Compra | Medify</title>
            <link rel="stylesheet" href="compra.css">
            <link rel="stylesheet" href="../../componentes/menu/menu.css">
    </head>
    <body>
        <?php
        include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header> 
                <h1>Administração | Compra de Medicamento</h1>
            </header>
            <form action="../../backend/compra/criarCompra.php" method="post">
                <div class="inputs">
                  <label for="">Data_solicitação:</label><input type="date" name="dt_solicitacao">
                  <label for="">Data_previsão:</label><input type="date" name="dt_previsao">
                  <label for="">Data_entrega:</label><input type="date" name="dt_entrega">
                  <label for="">Data_pagamento:</label><input type="date" name="dt_pagamento">
                  <select name="situacao">
                   <option value="">Situação</option>
                   <?php
                   if(isset($arrSituacao)){
                    foreach($arrSituacao as $situacao) {
                        echo("<option value=" .$situacao["id"]. ">" .$situacao["descricao"] . "</option>");
                    }
                   }
                   ?>
                   </select>
                   <select name="medicamento">
                   <option value="">Medicamento 1</option>
                   <?php
                   if(isset($arrMedicamento)){
                    foreach($arrMedicamento as $medicamento) {
                        echo("<option value=" .$medicamento["id"]. ">" .$medicamento["nome"] . "</option>");
                    }
                   }
                   ?>
                   </select>
                   <select name="medicamento">
                   <option value="">Medicamento 2</option>
                   <?php
                   if(isset($arrMedicamento)){
                    foreach($arrMedicamento as $medicamento) {
                        echo("<option value=" .$medicamento["id"]. ">" .$medicamento["nome"] . "</option>");
                    }
                   }
                   ?>
                   </select>
                   <select name="medicamento">
                   <option value="">Medicamento 3</option>
                   <?php
                   if(isset($arrMedicamento)){
                    foreach($arrMedicamento as $medicamento) {
                        echo("<option value=" .$medicamento["id"]. ">" .$medicamento["nome"] . "</option>");
                    }
                   }
                   ?>
                   </select>
                   <select name="medicamento">
                   <option value="">Medicamento 4</option>
                   <?php
                   if(isset($arrMedicamento)){
                    foreach($arrMedicamento as $medicamento) {
                        echo("<option value=" .$medicamento["id"]. ">" .$medicamento["nome"] . "</option>");
                    }
                   }
                   ?>
                   </select>
                   <div class="controles">
                   <button type="submit" class="salvar">Salvar</button>
                   <button type="reset" class="cancelar">Cancelar</button>
                   <?php
                       echo('<p>' .$mensagem. '</p>')
                   ?>
                   
                   <label>Quantidade:</label><input type="number" name="quantidade">
                   <label>Quantidade:</label><input type="number" name="quantidade">
                   <label>Quantidade:</label><input type="number" name="quantidade">
                   <label>Quantidade:</label><input type="number" name="quantidade">
                   </div>
                </div>
                   
            </form>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                        <th>Ação</th>
                        <th>dt_solicitacao</th>
                        <th>dt_previsao</th>
                        <th>dt_entregue</th>
                        <th>dt_pagamento</th>
                        <th>situacao</th>
                    </tr>
                    <?php

                    //Utilizar a função foreach
                    //para iterar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $compra){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$compra['id']."</td>
                                <td>".$compra['dt_solicitacao']."</td>
                                <td>".$compra['dt_previsao']."</td>
                                <td>".$compra['dt_entregue']."</td>
                                <td>".$compra['dt_pagamento']."</td>
                                <td>".$compra['situacao']."</td>
                            </tr>
                        ");
                    }

                    ?>
                </table>
            </div>
        </section>
    </body>
</html>