<?php
session_start();

include_once("../models/Contatos.php");

$obj = new Contatos();

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$obj->EditarContato($id, $nome, $email, $telefone);
?>