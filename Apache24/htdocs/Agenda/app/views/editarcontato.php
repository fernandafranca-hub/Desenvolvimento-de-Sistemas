<?php

session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

include_once("../models/Contatos.php");

$obj = new Contatos();

/* valida ID */
$id = $_GET["var"] ?? null;

if (!$id) {
    echo "<script>
        alert('Contato inválido!');
        window.location.href='contatos.php';
    </script>";
    exit;
}

/* busca contato */
$resp = $obj->BuscarContatoPorId($id);

if (!$resp) {
    echo "<script>
        alert('Contato não encontrado!');
        window.location.href='contatos.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="../../public/css/styles_black.css">
</head>

<body>

<aside>
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

    <h1>Editar Contato</h1>

    <a href="contatos.php" class="voltar">← Voltar</a>

    <form action="../controllers/editarcontato.php"
          method="POST"
          enctype="multipart/form-data">

        <!-- ID do contato -->
        <input type="hidden" name="id_contatos" value="<?=$resp['id_contatos'];?>">

        <div class="dadospessoais">

            <div class="perfil">

                <img class="foto-perfil" src="<?=$resp["url"];?>" alt="foto contato">

                <h3><?=$resp["nome"];?></h3>
                <p><?=$resp["email"];?></p>

                <br>

                <!-- FOTO CORRETA -->
                <input type="file" name="arquivo" id="foto" style="display:none;">
                <label for="foto" class="buttonE">Alterar foto</label>

            </div>

            <div class="formulario">

                <label>Nome completo</label>
                <input type="text" name="nome" value="<?=$resp["nome"];?>" required>

                <label>E-mail</label>
                <input type="email" name="email" value="<?=$resp["email"];?>" required>

                <label>Telefone</label>
                <input type="text" name="telefone" value="<?=$resp["telefone"];?>" required>

                <label>Descrição pessoal</label>
                <textarea name="descricao" rows="5"><?=$resp["descricao"];?></textarea>

                <button type="submit" class="buttonE">
                    Salvar alterações
                </button>

            </div>

        </div>
    </form>

</div>

</body>
</html>