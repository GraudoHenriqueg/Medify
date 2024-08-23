<?php 
  include_once '../../componentes/menu/menu.php';
  include_once '../../backend/produto_venda/relatorioProdutov.php';
  include_once '../../backend/produto_compra/relatorioProduto.php';
  include_once '../../backend/relatorio_home/relatorio_home.php';

?>

<html>
  <head>
<link rel="stylesheet" href="home.css">
  </head>
  <body>
  <?php
//Inclui o relatório de usuário
include_once '../../backend/movimento/relatorioMovimento.php';



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
    <head>
        <title>Usuario | Medify</title>
            <link rel="stylesheet" href="../../componentes/menu/menu.css">
    </head>
        <?php
        include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header> 
                <h1>Administração | Cadastro de Medicamento</h1>
            </header>
            <div class="relatorio">
                <h1>Relatório Compra</h1>
                <table>
                    <tr>
                        <th>Medicamento</th>
                        <th>Quantidade em estoque</th>
                    </tr>
                    <?php

                    //Utilizar a função foreach
                    //para iterar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorioCompra as $compra){
                        echo("
                            <tr>
                                <td>".$compra['nome']."</td>
                                <td>".$compra['quantidade']."</td>
                            </tr>
                        ");
                    }
                    ?>
                    </table>
                    <table>
                    <h1>Relatório Venda</h1>

                    <tr>
                        <th>Medicamento</th>
                        <th>Quantidade em estoque</th>
                    </tr>

                    <?php
                    foreach($relatorioVenda as $venda){
                        echo("
                            <tr>
                                <td>".$venda['nome']."</td>
                                <td>".$venda['quantidade']."</td>
                            </tr>
                        ");
                    }
                   ?>
                </table>
                <table>
                    <h1>Relatório Estoque</h1>

                    <tr>
                        <th>Medicamento</th>
                        <th>Quantidade em estoque</th>
                    </tr>

                    <?php
                    foreach($relatorioHome as $home){
                        echo("
                            <tr>
                                <td>".$home['nome']."</td>
                                <td>".$home['estoque']."</td>
                            </tr>
                        ");
                    }
                   ?>
                </table>
            </div>
        </section>
  </body>
</html>