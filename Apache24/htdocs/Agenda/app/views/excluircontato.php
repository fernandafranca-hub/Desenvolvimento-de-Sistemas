<?php

session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}
  
        include_once("../models/user.php");

        $obj = new User();
        $resp = $obj->ListarUmUsuario( $_SESSION["email"]);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../public/css/styles_black.css">
</head>

<body>

<aside>
    <div class="menu-esquerda">
        <span class="agenda">📅 Agenda</span><br /><br />
        <a href="pagina_inicial.php" class="item">📊 Dashboard</a>
        <a href="contatos.php" class="item">👤 Contatos</a>
        <a href="compromissos.php" class="item">📋 Compromissos</a>
        <a href="perfil.php" class="item">👨 Perfil</a>
        <a href="configuracoes.php" class="item">🗓️ Calendário</a>
        <a href="logoff.php" class="item">↩️ Sair</a>
    </div>
</aside>

<div class="menu-direita">

    <h2>Meu Perfil</h2>
    <br />

    <form action="../controllers/upload.php" method="POST" enctype="multipart/form-data">

        <div class="dadospessoais">
            <div class="perfil">
                <img class="foto-perfil" src="<?=$resp["url"];?>" />
                <h3><?=$resp["nome"];?></h3>
                <br />
                <p><?=$resp["email"];?></p>
                <br />
                <input id="foto" name="arquivo" type="file" hidden />
                <label for="foto"> Alterar foto</label>

            </div>

            <div class="formulario">
                <label>Nome completo</label>
                <input type="text" name="nome" value="<?=$resp["nome"];?>">
                <label>E-mail</label>
                <input type="email" name="email" value="<?=$resp["email"];?>">
                <label>Telefone</label>
                <input type="text" name="telefone" value="<?=$resp["telefone"];?>">
                <label>Descrição pessoal</label>
                <textarea name="descricao" rows="5"><?=$resp["descricao"];?></textarea>    
                <button class="button" type="submit">Salvar alterações</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>

