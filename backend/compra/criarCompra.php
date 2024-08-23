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
        insert into tb_ordem_de_compra(
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

     $stmt3 = $conexao->prepare("insert into fk_oc_item(
         ordem_de_compra,medicamento,quantidade   
         ) values(:ordem_de_compra,:medicamento,:quantidade)");
      $stmt3->bindParam(':ordem_de_compra',$id,PDO::PARAM_INT);
      $stmt3->bindParam(':medicamento',$requisicao["medicamento"],PDO::PARAM_INT);
      $stmt3->bindParam(':quantidade',$requisicao["quantidade"],PDO::PARAM_INT);

      $stmt3->execute();
      //Ao executar, prescisamos verificar se o valor foi de fato
      //inserido no banco de dados, para isso verificamos se o valor do
      //rowCount() é igual a 1 (quantidade de linhas que foram inseridas)
      if($stmt->rowCount()==1){
         //Caso isso seja positivo, retorna para a página de cadastro
         //com o status 201 (Created)
         header('Location: ../../paginas/cad-compra/compra.php?status=201');
         //Morre a execução para evitar lacunas de segurança
         die();
      } else{
         //Caso a quantidade não seja 1, retorna com o status
         //400 (Bad Request), informando que faltou algo
         header('Location: ../../paginas/cad-compra/compra.php?status=400');
         die();
      }



 }catch(PDOException $e){

print_r($e);
 }
?>