<?php
session_start();

include_once("../models/User.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    $obj = new User();
    $foto = $obj->EditarPerfil($nome, $email, $telefone, $descricao);

    
    
    
    /*
    if ($foto || $nome || $email) {

        echo "<script>
            alert('Perfil atualizado com sucesso!');
            window.location.href='http://localhost/agenda/app/views/perfil.php';
        </script>";

    } else {

        echo "<script>
            alert('Nenhuma alteração realizada');
            window.location.href='http://localhost/agenda/app/views/perfil.php';
        </script>";
    }*/

}
?>