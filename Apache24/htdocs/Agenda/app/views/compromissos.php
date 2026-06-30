<?php

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

include_once("../models/Compromissos.php");

$obj = new Compromissos();

$buscar = $_GET["buscar"] ?? "";

$usuario = $_SESSION["id"];

if (!empty($buscar)) {
    $resp = $obj->BuscarCompromissos($buscar, $usuario);
} else {
    $resp = $obj->ListarTodosCompromissos();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compromissos</title>
    <link rel="stylesheet" href="../../public/css/styles_black.css">
</head>

<body>

    <aside>
        <div class="menu-esquerda">
            <span class="agenda">📅 Agenda</span><br><br>
            <a href="dashboard.php" class="item">📊 Dashboard</a>
            <a href="contatos.php" class="item">👤 Contatos</a>
            <a href="compromissos.php" class="item">📋 Compromissos</a>
            <a href="perfil.php" class="item">👨 Perfil</a>
            <a href="configuracoes.php" class="item">🗓️ Calendário</a>
            <a href="logoff.php" class="item">↩️ Sair</a>
        </div>
    </aside>

    <div class="menu-direita"> 
            <h1>Compromissos</h1>
        <div class="filtro-contatos">
           <form method="GET" class="filtro-contatos">
                <input type="text" name="buscar" class="buscar" placeholder="Buscar compromissos...">
                <button type="submit" class="btn-buscar">Buscar</button>
                <a href="compromissos.php" class="novo-contato">Limpar</a>
            </form>
            <a href="novocompromisso.php" class="novo-contato">+ Novo Compromisso</a>
        </div>

        <div class="tabela-contatos">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Local</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($resp as $compromisso): ?>

                        <tr>

                            <td><?= $compromisso["titulo"]; ?></td>
                            <td><?= date('d/m/Y', strtotime($compromisso["data_compromisso"])); ?></td>
                            <td><?= date('H:i', strtotime($compromisso["hora_compromisso"])); ?></td>
                            <td><?= $compromisso["local_compromisso"]; ?></td>
                            <td><?= $compromisso["descricao"]; ?></td>
                            <td><a href="editarcompromisso.php?var=<?= $compromisso["id_compromissos"]; ?>"class="editar">✏️</a>
                            <a href="../controllers/excluircompromissos.php?var=<?= $compromisso["id_compromissos"]; ?>"class="excluir"
                            onclick="return confirm('Deseja excluir este compromisso?');">🗑️</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>