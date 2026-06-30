<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    include_once("../models/User.php");

    $obj = new User();
    $resp = $obj->ValidarLogin($email, $senha);

    if ($resp == TRUE) {

      
        $_SESSION["id_usuarios"] = $obj->ListarUmUsuario($email)["id_usuarios"];
        $_SESSION["email"] = $email;
        $_SESSION["login"] = md5($email);

        
        header("Location: ../views/dashboard.php");
        exit;

    } else {

       /* echo '<script>
            alert("Senha ou Usuário Inválido, tente novamente.");
            window.location.href="http://localhost/index.html";
        </script>';*/
    }
}
?>