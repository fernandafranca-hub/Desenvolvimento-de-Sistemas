<?php

session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <link rel="stylesheet" href="../../public/css/styles_black.css">
</head>

<body>
<aside >

    <div class="menu-esquerda">
        <span class="agenda">📅 Agenda</span><br /><br />
        <a href="dashboard.php" class="item">📊 Dashboard</a>
        <a href="contatos.php" class="item">👤 Contatos</a>
        <a href="compromissos.php" class="item">📋 Compromissos</a>
        <a href="perfil.php" class="item">👨 Perfil</a>
        <a href="configuracoes.php" class="item">🗓️ Calendário</a>
        <a href="logoff.php" class="item">↩️ Sair</a>
</div>
</aside>

<div class="menu-direita">

    <a href="compromissos.php" class="voltar">← Voltar</a>

    <h2>Novo Compromisso</h2>

    <form action="../controllers/cadastrar_compromissos.php" method="POST" enctype="multipart/form-data">

        <div class="formulario">

            <label>Título</label>
            <input type="text" name="titulo" placeholder="Digite o título">

            <label>Data</label>
            <input type="date" name="data">

            <label>Hora</label>
            <input type="time" name="hora"> 

            <label>Local</label> 
            <input type="text" name="local" placeholder="Digite o local">

            <label>Descrição</label>
            <textarea name="descricao"></textarea>
            <button class="buttonE" type="submit"> Salvar Compromisso </button>

        </div>

    </form>

</div>

</body>
</html>