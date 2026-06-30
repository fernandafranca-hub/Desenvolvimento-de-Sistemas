<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    require_once("Produto.php");
    $obj = new Produto();
    $exec = $obj->cadastrarProduto($_POST["nome"],$_POST["preco"],$_POST["quantidade"],$_POST["descricao"]);

    if($exec == TRUE)
        {
        $msg = "Produto cadastrado com sucesso!";
        }
    else
        {
        $msg = "Erro ao cadastrar produto!";
        }
}
else
{
    header("Location: cadastro_produto.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=cadastro_produto.php">

    <title>Resultado</title>
</head>
<body>

<h2><?= $msg; ?></h2>

<p>Redirecionando...</p>

</body>
</html>