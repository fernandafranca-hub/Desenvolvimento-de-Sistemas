<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
</head>
<body>
    <h1>Cadastro de Aluno</h1>
    <form method="post" action="Salvar.php">
    <label>Nome do Aluno</label>
    <input type="text" name="nome" placeholder="Digite o Nome" />
    <br />
    <label>E-mail</label>
    <input type="text" name="email" placeholder="Digite o E-mail " />
    <br />
    <input type="submit" name="cadastrar" value="Cadastrar" />
    </form>
    <form method="post" action="visualizar.php">
        <input type="submit" value="Listar" name="listar" />
    </form>
</body>
</html>