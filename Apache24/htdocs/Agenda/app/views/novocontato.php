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

    <a href="contatos.php" class="voltar">← Voltar</a>

    <h2>Novo Contato</h2>

    <form action="../controllers/cadastrar_contatos.php" method="POST" enctype="multipart/form-data">

        <div class="formulario">     
            

                <label>Foto</label>
                <input type="file" name="arquivo">

                <label>Nome completo</label>
                <input type="text" name="nome" placeholder="Digite o nome">

                <label>Telefone</label>
                <input type="text" name="telefone" placeholder="(11) 90000-0000">

                <label>E-mail</label>
                <input type="email" name="email" placeholder="email@exemplo.com">

                <label>Observações</label>
                <textarea name="descricao"></textarea>

                <button class="buttonE" type="submit">
                    Salvar Contato
                </button>     
        </div>
    </form>
</div>
</body>
</html>