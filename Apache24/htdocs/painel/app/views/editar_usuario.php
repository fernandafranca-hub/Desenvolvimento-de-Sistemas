<?php
session_name("painel");
session_start();

if(!isset($_SESSION["login"]))
{
   echo '<script>            
     window.location.href="http://localhost/painel";
    </script>'; 
}


        $id = $_GET["var"];
        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->ListarUmUsuario($id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="../../public/css/style_editar_usuario.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="box">

        <h1>Editar Usuário</h1>

        <form action="../controllers/editar_usuario_controller.php" method="POST">

            <input type="hidden" name="id" value="1">


            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $resp["email"]; ?>">
            </div>

            <button type="submit" name="acao" value="editar">
                Atualizar
            </button>

        </form>

    </div>

</body>
</html>