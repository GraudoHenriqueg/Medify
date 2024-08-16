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
            u.id,
            u.nome,
            u.sobrenome,
            u.telefone,
            u.login,
            u.cargo,
            t.descricao
        from tb_usuario u
            inner join tb_tipo t on t.id = u.cargo
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