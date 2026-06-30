<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);

        include_once("../models/User.php");

        $obj = new User();
        $obj->CadastrarUsuario($nome,$email,$senha);

    }
?>
