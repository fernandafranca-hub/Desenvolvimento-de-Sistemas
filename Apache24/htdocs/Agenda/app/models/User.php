<?php
class User
{
    private string $name;
    private string $login;
    private string $password;
    private string $telefone;
    private string $descricao;
    private $pdo;

    public function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ValidarLogin($email, $senha) // FUNCIONANDO 
    {
        $this->login = $email;
        $this->password = $senha;

        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND ativo = TRUE;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $this->login);
        $stmt->bindParam(':senha', $this->password);
        $stmt->execute();

        $vetor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($vetor["email"]) && isset($vetor["senha"])) {
            $_SESSION["id"] = $vetor["id_usuarios"];
            $_SESSION["usuario"] = $vetor["nome"];
            $_SESSION["email"] = $vetor["email"];
            return true;
        }

        return false;
    }

   
    public function EditarPerfil($nome, $email, $telefone, $descricao) //FUNCIONANDO
    {
        $usuarioLogado = $_SESSION['usuario'] ?? 'usuario';
     
        $pastaDestino = __DIR__ . "/../../fotos_perfil/";

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] != 0) {
            return false;
        }

        $arquivo = $_FILES['arquivo'];

        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extensao, $permitidas)) {
            return false;
        }

        $usuarioLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuarioLogado);
       
        $novoNomeArquivo = md5($usuarioLimpo) . "." . $extensao;



        $caminhoArquivo = $pastaDestino . $novoNomeArquivo;
        $url = "../../fotos_perfil/".$novoNomeArquivo; 

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
             
       
        
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, descricao = :descricao, url = :url WHERE email = :email;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':url', $url);

        if ($stmt->execute()) {
        echo '<script>
            alert("Perfil atualizado com sucesso!");
            window.location.href="../views/perfil.php";
        </script>';
        }
        else {
        echo "Erro ao atualizar contato.";
        }

            return $novoNomeArquivo;
        }

        return false;
    }

    public function CadastrarUsuario($nome, $email, $senha) // FUNCIONANDO 
    {
        $this->name = $nome;
        $this->login = $email;
        $this->password = $senha;

        $sql = "INSERT INTO usuarios (nome, email, senha, ativo) 
                VALUES (:nome, :email, :senha, 'true');";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $this->name);
        $stmt->bindParam(':email', $this->login);
        $stmt->bindParam(':senha', $this->password);

        if ($stmt->execute()) {
            echo '<script>
                alert("Usuário cadastrado com sucesso.");
                window.location.href="http://localhost/agenda";
            </script>';
        }
        else
        {
            echo "Email não disponível";
        }
    }   
    
    public function ListarUmUsuario($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);        
        if($stmt->execute())
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return($result);
            }
            else
            {
                return (FALSE);
            }
       
    }


}
?>



  