<?php
session_name("painel");
session_start();

if(!isset($_SESSION["login"]))
{
   echo '<script>            
     window.location.href="http://localhost/painel";
    </script>'; 
}

?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link href="../../public/css/style_cadastrar_usuario.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="box">

        <h1>Cadastrar Usuário</h1>

        <form action="../controllers/cadastrar_usuario_controller.php" method="POST">

                <div class="input-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="senha">
            </div>

            <button type="submit" name="acao" value="cadastrar">
                Cadastrar
            </button>

        </form>

    </div>

</body>
</html>