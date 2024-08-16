<?php

//Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';

//Inicializa variavel de mensagem
$mensagem_erro = '';

//Inicia a estrutura de tentativa try
try{

   //Prepara a query SQL para execução
   $preparo = $conexao->prepare("
        select
            id,
           quantidade,
           ordem_de_compra,
           medicamento,
           tipo
        from tb_medicamento

        
   ");
   //Executa a query
   $preparo->execute();

   //Coloca o resultado em um array usando fetch_assoc
   $relatorio = $preparo->fetchALL();

   //#### Testar se deu certo remover depois ####
   //foreach($relatorio as $linha){
    //print_r($linha);
   //}


}catch(PDOException){
    //Imprime o erro na tela
    print_r($erro);
    //Coloca que deu erro na variavel mensagem_erro
    $mensagem_erro = 'erro';
}








?>