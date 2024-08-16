<?php

//Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';

//Coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;
$senha = sha1('ch0c0l4t3');

//Utiliza uma estrutura de tentativa para tentar
//inserir as informações no banco de dados
try{
    //Utiliza o método prepare() da variável conexao que está disponivel
    //no arquivo por meio do require_once), para preparar uma instrução
    //sql (banco de dados)
        $stmt = $conexao->prepare("
        insert into tb_ordem_compra(
           dt_solicitacao, dt_previsao,  dt_entregue, dt_pagamento, situacao
        ) values (
           :dt_solicitacao, :dt_previsao, :dt_entregue,:dt_pagamento, :situacao
        )
     ");
     //Utiliza o método bindParam da classe PreparedStatement disponível
     //na variavel preparação, que recebeu a preparação acima.
     //A função bindParam troca um dos parametros da instrução sql pelo
     //valor contido em uma variável. Não esquecer de mudar o tipo no
     //ultimo argumento.
     $stmt->bindParam(':dt_solicitacao',$requisicao['dt_solicitacao'],PDO::PARAM_STR);
     $stmt->bindParam(':dt_previsao',$requisicao['dt_previsao'],PDO::PARAM_STR);
     $stmt->bindParam(':dt_entregue',$requisicao['dt_entregue'],PDO::PARAM_STR);
     $stmt->bindParam(':dt_pagamento',$requisicao['dt_pagamento'],PDO::PARAM_STR);
     $stmt->bindParam(':situacao',$requisicao['situacao'],PDO::PARAM_INT);
     //Ao final da troca dos parametros, estamos prontos para executar
     //a instrução, por isso utilizamos o método execute() da classe
     //PreparedStatement
     $stmt->execute();
     
     $stmt2 = $conexao->prepare('select last_insert_id() as id');
     $stmt2->execute();
     $res = $stmt2->fetchALL();
     $id = $res[0]['id'];

     $stmt3 = $conexao->prepare("insert into tb_oc_item(
         ordem_compra,medicamento,quantidade   
         ) values(:ordem_compra,:medicamento,:quantidade)");
      $stmt->bindParam(':ordem_compra',$id,PDO::PARAM_INT);
      $stmt->bindParam(':medicamento',$valores["medicamento"],PDO::PARAM_INT);
      $stmt->bindParam(':quantidade',$valores["quantidade"],PDO::PARAM_INT);
 }catch(PDOException $e){


 }
?>