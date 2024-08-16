<?php

if($_GET){
    if($_GET ['erro']){
        $erro = $_GET['erro'];
    }
}


?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="index.css">
        <link rel="icon" href="./assets/img/favicon-96x96.png">
    </head>
    <body>
        <section>
            <h1>Medify</h1>
            <div class="centro">
             <form class="form" action="backend/login/login.php" method="post">
              <input type="text" placeholder="E-mail ou nome de usuário" name="usuario">
              <input type="password" placeholder="Senha" name="senha">
              <button type="submit" class="entrar">Entrar</button>
              <hr>
              <button class="esqueceu">Esqueceu sua senha?</button>
              <button class="registro">Registrar-se</button>
              </form>
              <?php
               
               if($erro){
                switch($erro){
                    case '401';
                    echo("<p class=\"erro\">Usuário ou senha inválido</p>");
                       break;
                    case '500';
                    echo("<p> class=\"erro\">Erro no servidor, tente novamente, mais tarde</p>");
                       break;
                }
               }
            
             ?>
            </div>
        </section>
    </body>
</html>