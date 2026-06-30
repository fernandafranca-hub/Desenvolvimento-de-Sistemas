<?php

include_once("../models/Compromissos.php");

$id = $_GET["var"] ?? null;

if (!$id) {
    echo "<script>
        alert('ID inválido!');
        window.location.href='../views/compromissos.php';
    </script>";
    exit;
}

$obj = new Compromissos();

$resultado = $obj->ExcluirCompromisso($id);

if ($resultado) {
    echo "<script>
        alert('Compromisso excluído com sucesso!');
        window.location.href='../views/compromissos.php';
    </script>";
} else {
    echo "<script>
        alert('Erro ao excluir compromisso!');
        window.location.href='../views/compromissos.php';
    </script>";
}