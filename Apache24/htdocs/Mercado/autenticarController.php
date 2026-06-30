<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login = $_POST["users"]; 
        $password = md5($_POST["pass"]); //md5 verificação se a senha que a pessoa digitou está correta. Pois, gera uma hash (cód diferente) que fica salvo no banco, assim não demonstrando a senha do usuário

        require_once("User.php");
        $obj = new User();
        $exec = $obj->getUser($login,$password);

        if($exec == TRUE)
        {
            $msg = "Login realizado com sucesso!";
        }
        else
        {
            $msg = "Senha ou usuário inválido.";
        }
    }
    else
    {
        header("Location: index.html");
        exit;
    }

?>