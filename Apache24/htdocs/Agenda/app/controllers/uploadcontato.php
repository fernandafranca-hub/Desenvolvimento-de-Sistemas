<?php
session_start();

include_once("../models/User.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    $obj = new User();
    $foto = $obj->CadastrarContato($nome, $email, $telefone, $descricao);
}