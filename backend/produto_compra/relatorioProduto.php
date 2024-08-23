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
    med.nome,
    sum(oci.quantidade) as quantidade
    from tb_ordem_de_compra oc
     inner join fk_oc_item oci on oci.ordem_de_compra = oc.id
     inner join tb_medicamento med on med.id = oci.medicamento
     where oc.situacao = 2
     group by med.nome;

        
   ");
   //Executa a query
   $preparo->execute();

   //Coloca o resultado em um array usando fetch_assoc
   $relatorioCompra = $preparo->fetchALL();

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