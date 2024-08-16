<?php
//Inclui o relatório de usuário
include_once '../../backend/medicamento/relatorioMedicamento.php';



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
        <title>Usuario | Medify</title>
            <link rel="stylesheet" href="medicamento.css">
            <link rel="stylesheet" href="../../componentes/menu/menu.css">
    </head>
    <body>
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
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Alta_Vigilancia</th>
                        <th>Ativo</th>
                    </tr>
                    <?php

                    //Utilizar a função foreach
                    //para iterar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $medicamento){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$medicamento['id']."</td>
                                <td>".$medicamento['nome']."</td>
                                <td>".$medicamento['valor']."</td>
                                <td>".$medicamento['alta_vigilancia']."</td>
                                <td>".$medicamento['ativo']."</td>
                            </tr>
                        ");
                    }

                    ?>
                </table>
            </div>
        </section>
    </body>
</html>