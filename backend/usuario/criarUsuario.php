<?php

//Requer conexão com o banco de dados
require_once '../database/conexao.php';

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
        $preparacao = $conexao->prepare("
        insert into tb_usuario(
           nome, sobrenome, endereco, telefone, login, senha, cargo
        ) values (
           :nome, :sobrenome, :endereco,:telefone, :login, :senha, :tipo 
        )
     ");
     //Utiliza o método bindParam da classe PreparedStatement disponível
     //na variavel preparação, que recebeu a preparação acima.
     //A função bindParam troca um dos parametros da instrução sql pelo
     //valor contido em uma variável. Não esquecer de mudar o tipo no
     //ultimo argumento.
     $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
     $preparacao->bindParam(':sobrenome',$requisicao['sobrenome'],PDO::PARAM_STR);
     $preparacao->bindParam(':endereco',$requisicao['endereco'],PDO::PARAM_STR);
     $preparacao->bindParam(':telefone',$requisicao['telefone'],PDO::PARAM_STR);
     $preparacao->bindParam(':login',$requisicao['usuario'],PDO::PARAM_STR);
     $preparacao->bindParam(':senha',$senha,PDO::PARAM_STR);
     $preparacao->bindParam(':tipo',$requisicao['tipo'],PDO::PARAM_INT);
     //Ao final da troca dos parametros, estamos prontos para executar
     //a instrução, por isso utilizamos o método execute() da classe
     //PreparedStatement
     $preparacao->execute();
     //Ao executar, prescisamos verificar se o valor foi de fato
     //inserido no banco de dados, para isso verificamos se o valor do
     //rowCount() é igual a 1 (quantidade de linhas que foram inseridas)
     if($preparacao->rowCount()==1){
        //Caso isso seja positivo, retorna para a página de cadastro
        //com o status 201 (Created)
        header('Location: ../../paginas/cad-usuario/usuario.php?status=201');
        //Morre a execução para evitar lacunas de segurança
        die();
     } else{
        //Caso a quantidade não seja 1, retorna com o status
        //400 (Bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-usuario/usuario.php?status=400');
        die();
     }
}catch(PDOException $erro){
   print_r($erro);
    //Executa caso receba algum erro
    //Volta para a página de cadastro e apresenta
    //Um erro do tipo 500 (Server Error)
    //header('Location: ../../paginas/cad-usuario/usuario.php?status=500');
}







?>