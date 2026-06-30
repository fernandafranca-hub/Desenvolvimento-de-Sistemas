<?php
session_name("painel");
session_start();

if(!isset($_SESSION["login"]))
{
   echo '<script>            
     window.location.href="http://localhost/painel";
    </script>'; 
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../../public/css/style_dashboard.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <header>

        <h1>Sistema MVC</h1>

        <nav>
            <a href="listar_usuario.php">Usuários</a>
            <a href="../controllers/logoff.php">Sair</a>
        </nav>

    </header>

    <div class="container">

        <div class="card">

            <h2>Bem-vindo ao Dashboard</h2>

            <br>

            <p>
                Sistema desenvolvido em PHP utilizando arquitetura MVC.
            </p>

        </div>

    </div>

</body>
</html>