<?php
session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}


include_once("../models/Compromissos.php");
include_once("../models/Contatos.php");

$comp = new Compromissos();
$cont = new Contatos();

$busca = $_GET["busca"] ?? "";
$usuarios = $_SESSION["id_usuarios"];

if (!empty($busca)) {

   
    $proximos = $comp->BuscarCompromissos($busca, $usuarios);
    $recentes = $cont->BuscarContatos($busca, $usuarios);

} else {
    $proximos = $comp->proximosCompromissos($usuarios);
    $recentes = $cont->contatosRecentes($usuarios);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
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
        <a href="#" class="item">↩️ Sair</a>
    </div>
</aside>

<div class="menu-direita">

   <form method="GET" class="filtro-contatos">
        <input type="text" name="busca" class="buscar" placeholder="Buscar contatos e compromissos..." value="<?= $_GET['busca'] ?? '' ?>">
        <button type="submit" class="btn-buscar">Buscar</button>
        <a href="dashboard.php" class="novo-contato">Limpar</a>
    </form>

    <br>
    <br>
    <br>

    <h1>Olá, <?= $_SESSION["usuario"]; ?>!</h1>
    <p>Bem-vindo à sua agenda eletrônica!</p>

    <br>
    <br>
    <br>

    <div class="historico">

        
        <div class="hist">
            <h3>Próximos compromissos</h3>

            <?php if(count($proximos) > 0): ?>
                <?php foreach($proximos as $c): ?>
                    <p>
                        <strong><?= date("d/m", strtotime($c["data_compromisso"])); ?></strong>
                        -
                        <?= $c["titulo"]; ?>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum compromisso próximo</p>
            <?php endif; ?>
        </div>

       
        <div class="hist">
            <h3>Contatos recentes</h3>

            <?php if(count($recentes) > 0): ?>
                <?php foreach($recentes as $ct): ?>
                    <p>
                        👤 <?= $ct["nome"] ?>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum contato cadastrado</p>
            <?php endif; ?>
        </div>

    </div>

</div>

</body>
</html>