<?php

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

include_once("../models/Contatos.php");

$obj = new Contatos();

if (isset($_GET["excluir"])) {

    $id = $_GET["excluir"];
    $resultado = $obj->ExcluirContato($id);

    if ($resultado) {
        echo "<script>
            alert('Contato excluído com sucesso!');
            window.location.href='contatos.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Erro ao excluir contato!');
            window.location.href='contatos.php';
        </script>";
        exit;
    }
}

$buscar = $_GET["buscar"] ?? null;

if ($buscar) {
    $resp = $obj->BuscarContatos($buscar, $_SESSION["id"]);
} else {
    $resp = $obj->ListarTodosContatos($_SESSION["id"]);
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
            <a href="calendario.php" class="item">🗓️ Calendário</a>
            <a href="../index.html" class="item">↩️ Sair</a>
        </div>
    </aside>

    <div class="menu-direita"> 
        <h1>Contatos</h1> 
        <div class="filtro-contatos"> 
            <form method="GET" class="filtro-contatos">
                <input type="text" name="buscar" class="buscar" placeholder=" Buscar contatos..." value="<?= $_GET['buscar'] ?? '' ?>">
                <button type="submit" class="btn-buscar">Buscar</button>
                <a href="contatos.php" class="novo-contato">Limpar</a>
            </form> 
             <a href="novocontato.php" class="novo-contato">+ Novo Contato</a>
        </div>

        <div class="tabela-contatos">
            
            <table>

                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>    
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Descrição</th>
                        <th>Ações</th>   
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($resp as $contatos): ?>
                        <tr>
                            <td>
                                <img class="avatar" src="<?=$contatos["url"];?>"/>
                            </td>

                            <td><?=$contatos["nome"];?></td>
                            <td><?=$contatos["telefone"];?></td>
                            <td><?=$contatos["email"];?></td>
                            <td><?=$contatos["descricao"];?></td>
                            <td><a href="editarcontato.php?var=<?=$contatos["id_contatos"];?>" class="editar">✏️</a>
                                <a href="contatos.php?excluir=<?=$contatos["id_contatos"];?>" class="excluir" 
                                onclick="return confirm('Deseja excluir?');">🗑️</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
        </div>       
    </div>
</body>

</html>