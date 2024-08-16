<?php 
  include_once '../../componentes/menu/menu.php'
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
            <link rel="stylesheet" href="medicamento.css">
            <link rel="stylesheet" href="../../componentes/menu/menu.css">
    </head>
        <?php
        include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header> 
                <h1>Administração | Cadastro de Medicamento</h1>
            </header>
            <form action="../../backend/medicamento/criarMedicamento.php" method="post">
                <div class="inputs">
                   <div class="linha">
                     <div class="controle">
                    <input type="text" name="nome" placeholder="Nome do Medicamento">
                    <select name="controlado">
                        <option value="">controlado</option>
                        <option value="300">sim</option>
                        <option value="301">não</option>
                    </select>
                     </div>
                    <select name="alta vigilancia">
                         <option value="">alta vigilancia</option>
                         <option value="300">sim</option>
                         <option value="301">não</option>
                    </select>
                    <select name="ativo">
                         <option value="">ativo</option>
                         <option value="300">sim</option>
                         <option value="301">não</option>
                    </select>
                    <label>Valor:</label><input type="text" name="valor">
                   <div class="controles">
                   <button type="submit" class="salvar">Salvar</button>
                   <button type="reset" class="cancelar">Cancelar</button>
                   <?php
                       echo('<p>' .$mensagem. '</p>')
                   ?>
                   </div>
                </div>
                   
                </div>
            </form>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                        <th>Ação</th>
                        <th>id</th>
                        <th>quantidade</th>
                        <th>ordem_de_compra</th>
                        <th>medicamento</th>
                        <th>tipo</th>
                    </tr>
                    <?php

                    //Utilizar a função foreach
                    //para iterar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $movimento){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$movimento['id']."</td>
                                <td>".$movimento['quantidade']."</td>
                                <td>".$movimento['ordem_de_compra']."</td>
                                <td>".$movimento['medicamento']."</td>
                                <td>".$movimento['tipo']."</td>
                            </tr>
                        ");
                    }

                    ?>
                </table>
            </div>
        </section>
  </body>
</html>