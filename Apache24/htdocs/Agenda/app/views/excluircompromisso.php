<?php

session_start();

include_once("../models/Compromissos.php");

$obj = new Compromissos();

$id = $_GET["var"];
$usuario = $_SESSION["id"];

$resultado = $obj->ExcluirCompromisso($id, $usuario);

if ($resultado) {
    echo "<script>
        alert('Excluído com sucesso');
        window.location.href='../views/compromissos.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao excluir');
        window.location.href='../views/compromissos.php';
    </script>";
}
?>