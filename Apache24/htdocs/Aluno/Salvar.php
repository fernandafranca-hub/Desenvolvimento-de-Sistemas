<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require_once("Aluno.php");
        $obj = new Aluno();
        $exec = $obj->cadastrarAluno($_POST["nome"],$_POST["email"]);

        if($exec == TRUE)
            {
                $msg = "Aluno Cadastrado com sucesso!";
            }
            else
                {
                    $msg = "Algo deu errado, tente novamente!";
                }
        }
        else
            {
            header("Location: cadastro alunop.php");
            exit;
            }
            
?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">

            <meta http-equiv="refresh" content="3;url=cadastro_aluno.php">

            <title>Resultado</title>
        </head>
        <body>

          <h2><?= $msg; ?></h2>

          <p>Redirecionando...</p>  

        </body>
        </html>
