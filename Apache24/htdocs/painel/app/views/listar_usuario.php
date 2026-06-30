<?php
session_name("painel");
session_start();

if(!isset($_SESSION["login"]))
{
   echo '<script>            
     window.location.href="http://localhost/painel";
    </script>'; 
}
// session para que não execute nenhuma função sem fazer login//

        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->ListarTodosUsuarios();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="../../public/css/style_listar_usuario.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="container">

        <div class="topo">

            <h1>Usuários</h1>

            <a href="cadastrar_usuario.php" class="btn">
                Novo Usuário
            </a>

        </div>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Ativo</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach($resp as $usuarios): ?>

                <tr>
                    <td><?=$usuarios["id_usuarios"]; ?></td>
                    <td><?=$usuarios["email"] ?></td>
                    <td><?=$usuarios["ativo"]; ?></td>
                    <td><a href="editar_usuario.php?var=<?=$usuarios["id_usuarios"]; ?>" class="editar">Editar</a></td>
                    <td><a href="excluir_usuario.php?var=<?=$usuarios["id_usuarios"]; ?>" class="excluir">Excluir</a></td>
                                     
                </tr>
                <?php endforeach?>

            </tbody>

        </table>

    </div>

</body>
</html>