<?php

include_once("../models/Contatos.php");

$id = $_POST["id_contato"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$descricao = $_POST["descricao"];
$url = $_POST["url"];

$obj = new Contatos();

$obj->EditarContatos($id, $email, $telefone, $nome, $url, $descricao);
?>
