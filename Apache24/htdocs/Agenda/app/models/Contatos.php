<?php
class Contatos
{
    private string $name;
    private string $email;
    private string $telefone;
    private string $descricao;
    private string $usuario_idfk;
    private $pdo;

    public function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function CadastrarContatos($nome, $telefone, $email, $descricao, $usuario_idfk)
    {
        $usuarioLogado =  $_SESSION["email"];
     
        $pastaDestino = __DIR__ . "/../../fotos_contatos/";

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

        $contatoLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuarioLogado);
       
        $novoNomeArquivo = md5($contatoLimpo) . "." . $extensao;



        $caminhoArquivo = $pastaDestino . $novoNomeArquivo;
        $url = "../../fotos_contatos/".$novoNomeArquivo; 

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {

        $this->name = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->descricao = $descricao;
        $this->usuario_idfk = $usuario_idfk;


        $sql = "INSERT INTO contatos (nome, email, telefone, descricao, usuario_idfk, url) 
                VALUES (:nome, :email, :telefone, :descricao, :usuario_idfk, :url);";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':usuario_idfk', $this->usuario_idfk);
        $stmt->bindParam(':url', $url);

        if ($stmt->execute()) {
            echo '<script>
                alert("Contato cadastrado com sucesso.");
                window.location.href="http://localhost/Agenda/app/views/novocontato.php";
            </script>';
        } 

        else {
            echo "Contato não cadastrado... tente novamente.";
        }
    }
    }
    
    public function EditarContatos($id_contato, $email, $telefone, $nome, $url, $descricao)
    {
        $sql = "UPDATE contatos SET email = :email, telefone = :telefone, nome = :nome, url = :url, descricao = :descricao 
        WHERE id_contatos = :id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id_contato);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':descricao', $descricao);
       

        if ($stmt->execute()) {
            echo '<script>
                alert("Contato atualizado com sucesso.");
                window.location.href="http://localhost/Agenda/app/views/contatos.php";
            </script>';
        } else {
            echo "Erro";
        }
    }


    public function ListarTodosContatos()
    {
        $sql = "SELECT * FROM contatos ORDER BY id_contatos ASC;";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute())
            {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return($result);
            }
            else
            {
                return (FALSE);
            }
            
    } 

    public function BuscarContatoPorId($id)
    {
        $sql = "SELECT * FROM contatos WHERE id_contatos = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute())
            {
            return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return false;
    }

    

    public function ExcluirContato($id_contatos)
    {
        $sql = "DELETE FROM contatos WHERE id_contatos = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_contatos);

        return $stmt->execute();
    }


    public function contatosRecentes($usuario_idfk)
    {
    $sql = "SELECT * FROM contatos WHERE usuario_idfk = :usuario ORDER BY id_contatos DESC LIMIT 5";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":usuario", $usuario_idfk);

    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];
    }


    public function BuscarContatos($texto, $usuario_idfk)
    {
        $sql = "SELECT * FROM contatos WHERE usuario_idfk = :usuario AND (nome LIKE :texto
                OR email LIKE :texto OR telefone LIKE :texto OR descricao LIKE :texto)
                ORDER BY id_contatos DESC";

        $stmt = $this->pdo->prepare($sql);
        $texto = "%".$texto."%";
        $stmt->bindParam(":texto", $texto);
        $stmt->bindParam(":usuario", $usuario_idfk);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

