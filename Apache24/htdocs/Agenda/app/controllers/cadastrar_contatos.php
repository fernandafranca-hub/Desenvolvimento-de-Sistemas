<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $descricao = $_POST["descricao"];

        include_once("../models/Contatos.php");

        $obj = new Contatos();
       $obj->CadastrarContatos($nome,$telefone,$email,$descricao, $_SESSION["id"]);

    }
?>