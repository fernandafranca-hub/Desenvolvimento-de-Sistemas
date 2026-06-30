<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);

        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->CadastrarUsuario($email,$senha);

        if($resp ==TRUE)
            {
                header("Location: ../views/dashboard.php");
            }
            else
                {
                    echo '<script>                    
                    {
                    alert("Senha ou Usuário Inválido, tente novamente.");
                    window.location.href="http://localhost/painel";
                    }
                    </script>';                    
                }
    }
?>