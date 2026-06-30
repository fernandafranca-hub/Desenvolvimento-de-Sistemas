<?php

session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

include_once("../models/Compromissos.php");

$obj = new Compromissos();

$id = $_GET["var"];

$resp = $obj->BuscarCompromissoPorId($id);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Compromisso</title>
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

    <a href="compromissos.php" class="voltar">← Voltar</a>

    <form action="../controllers/editarcompromisso.php" method="POST">
        <input type="hidden" name="id_compromissos"value="<?=$resp['id_compromissos'];?>">

        <div class="dadospessoais">
            <div class="perfil">
                <h2><?=$resp["titulo"];?></h2>
                <h3><?=$resp["local_compromisso"];?></h3>
                <h3><?=date('d/m/Y', strtotime($resp["data_compromisso"]));?></h3> 
                <p><?=date('H:i', strtotime($resp["hora_compromisso"]));?></p>
            </div>

           
            <div class="formulario">
                <label>Título</label>
                <input type="text" name="titulo" value="<?=$resp["titulo"];?>">
                <label>Data</label>
                <input type="date" name="data" value="<?=$resp["data_compromisso"];?>">
                <label>Hora</label><input type="time" name="hora" value="<?=$resp["hora_compromisso"];?>">

                <label>Local</label>
                <input type="text" name="local" value="<?=$resp["local_compromisso"];?>">
                <label>Descrição</label>
                <textarea name="descricao" rows="5"><?=$resp["descricao"];?></textarea>
                <button class="buttonE" type="submit">Salvar alterações</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>