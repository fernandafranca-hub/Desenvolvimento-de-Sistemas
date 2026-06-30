<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $id = $_POST["id"];

        include_once("../models/User.php");

        $obj = new User();
        $obj->EditarUsuario($id, $email);

    }
?>