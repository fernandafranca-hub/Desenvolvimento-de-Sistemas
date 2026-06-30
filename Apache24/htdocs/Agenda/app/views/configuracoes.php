<?php
session_start();

if (!isset($_SESSION["id_usuarios"])) {
    header("Location: http://localhost/Agenda/index.html");
    exit;
}

include_once("../models/Compromissos.php");

$obj = new Compromissos();

$mesAtual = $_GET["mes"] ?? date("m");
$anoAtual = $_GET["ano"] ?? date("Y");

$mesAtual = str_pad($mesAtual, 2, "0", STR_PAD_LEFT);

$primeiroDiaMes = $anoAtual . "-" . $mesAtual . "-01";
$ultimoDiaMes = date("Y-m-t", strtotime($primeiroDiaMes));

$compromissos = $obj->listarPorPeriodo(
    $primeiroDiaMes,
    $ultimoDiaMes,
    $_SESSION["id"]
);

$diaSemanaInicio = date("N", strtotime($primeiroDiaMes));
$totalDiasMes = date("t", strtotime($primeiroDiaMes));

$nomeMes = [
    "01" => "Janeiro",
    "02" => "Fevereiro",
    "03" => "Março",
    "04" => "Abril",
    "05" => "Maio",
    "06" => "Junho",
    "07" => "Julho",
    "08" => "Agosto",
    "09" => "Setembro",
    "10" => "Outubro",
    "11" => "Novembro",
    "12" => "Dezembro"
];

$mesTitulo = $nomeMes[$mesAtual];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link rel="stylesheet" href="../../public/css/styles_calendar.css">
</head>

<body>

<aside>
    <div class="menu-esquerda">
        <span class="agenda">📅 Agenda</span><br><br>
        <a href="dashboard.php" class="item">📊 Dashboard</a>
        <a href="contatos.php" class="item">👤 Contatos</a>
        <a href="compromissos.php" class="item">📋 Compromissos</a>
        <a href="perfil.php" class="item">👨 Perfil</a>
        <a href="calendario.php" class="item">🗓️ Calendário</a>
        <a href="Agenda/app/controllers/logoff.php" class="item">↩️ Sair</a>
    </div>
</aside>

<div class="menu-direita">
    <h1><?= $mesTitulo ?> de <?= $anoAtual ?></h1>
  <div class="btncalendar">
        <form method="GET" class="selecionar-mes">

            <select name="mes">
                <?php foreach($nomeMes as $numero => $nome): ?>
                    <option value="<?= $numero ?>"
                        <?= ($numero == $mesAtual) ? "selected" : "" ?>>
                        <?= $nome ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="ano">
                <?php for($ano = date("Y") - 5; $ano <= date("Y") + 5; $ano++): ?>
                    <option value="<?= $ano ?>"
                        <?= ($ano == $anoAtual) ? "selected" : "" ?>>
                        <?= $ano ?>
                    </option>
                <?php endfor; ?>
            </select>

            <button type="submit" class="btn-buscar">
                Ver calendário
            </button>
        </form>
    </div>
    <br>

    <div class="calendario">

        <div class="cabecalho">Seg</div>
        <div class="cabecalho">Ter</div>
        <div class="cabecalho">Qua</div>
        <div class="cabecalho">Qui</div>
        <div class="cabecalho">Sex</div>
        <div class="cabecalho">Sáb</div>
        <div class="cabecalho">Dom</div>

        <?php for($i = 1; $i < $diaSemanaInicio; $i++): ?>
            <div class="dia vazio"></div>
        <?php endfor; ?>

        <?php for($dia = 1; $dia <= $totalDiasMes; $dia++): ?>

            <div class="dia">

                <div class="numero">
                    <?= $dia ?>
                </div>

                <?php foreach($compromissos as $compromisso): ?>

                    <?php
                    $diaCompromisso = date(
                        "j",
                        strtotime($compromisso["data_compromisso"])
                    );
                    ?>

                    <?php if($diaCompromisso == $dia): ?>

                        <div class="evento">

                            <strong>
                                <?= date("H:i", strtotime($compromisso["hora_compromisso"])) ?>
                            </strong>

                            <br>

                            <?= $compromisso["titulo"] ?>

                            <br>

                            <small>
                                <?= $compromisso["local_compromisso"] ?>
                            </small>

                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

        <?php endfor; ?>

    </div>

</div>

</body>
</html>