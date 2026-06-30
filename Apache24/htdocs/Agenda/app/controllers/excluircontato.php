<?php

include_once("../models/Contatos.php");

$id = $_GET["var"] ?? null;

if (!$id) {
    echo "<script>
        alert('ID inválido!');
        window.location.href='contatos.php';
    </script>";
    exit;
}

$obj = new Contatos();

$resultado = $obj->ExcluirContato($id);

if ($resultado) {
    echo "<script>
        alert('Contato excluído com sucesso!');
        window.location.href='contatos.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao excluir contato!');
        window.location.href='contatos.php';
    </script>";
}