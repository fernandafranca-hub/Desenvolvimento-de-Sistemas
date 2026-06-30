<?php

session_start();

include_once("../models/Compromissos.php");

$obj = new Compromissos();

$id = $_POST["id_compromissos"];
$titulo = $_POST["titulo"];
$data = $_POST["data"];
$hora = $_POST["hora"];
$local = $_POST["local"];
$descricao = $_POST["descricao"];
$usuario = $_SESSION["id"];

$resultado = $obj->EditarCompromisso($id, $titulo, $data, $hora, $local, $descricao, $usuario);

if ($resultado) {
    echo "<script>
        alert('Atualizado com sucesso');
        window.location.href='../views/compromissos.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao atualizar');
        window.location.href='../views/compromissos.php';
    </script>";
}
?>