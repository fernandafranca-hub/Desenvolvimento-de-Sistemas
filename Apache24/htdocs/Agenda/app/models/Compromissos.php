<?php

class Compromissos
{
    private string $name;
    private string $email;
    private string $titulo;
    private string $telefone;
    private string $data_compromisso;
    private string $local_compromisso;
    private string $hora_compromisso;
    private string $descricao;
    private string $usuario_idfk;
    private $pdo;

    public function __construct()
    {
        include_once("Connect.php");

        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function CadastrarCompromisso( $titulo, $data, $hora, $local, $descricao, $usuario_idfk )
    
    {
        $sql = "INSERT INTO compromissos (titulo, data_compromisso, hora_compromisso, local_compromisso, descricao, usuario_idfk)
        VALUES (:titulo, :data, :hora, :local, :descricao, :usuario)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':local', $local);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':usuario', $usuario_idfk);

        if($stmt->execute()) {
            echo '<script>
                alert("Compromisso cadastrado com sucesso");
               window.location.href="http://localhost/Agenda/app/views/novocompromisso.php";
            </script>';
        }
        else {
            echo "Compromisso não cadastrado... tente novamente.";
        }
    }

    public function ListarTodosCompromissos()
    {
        $sql = "SELECT * FROM compromissos ORDER BY data_compromisso ASC, hora_compromisso ASC";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute())
        {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function BuscarCompromissoPorId($id)
{
    $sql = "SELECT * FROM compromissos WHERE id_compromissos = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    if($stmt->execute()){
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return false;
}

    public function EditarCompromisso($id, $titulo, $data, $hora, $local, $descricao)
{
    $sql = "UPDATE compromissos SET titulo = :titulo, data_compromisso = :data, hora_compromisso = :hora, local_compromisso = :local, descricao = :descricao
            WHERE id_compromissos = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id_compromisso);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":data", $data);
    $stmt->bindParam(":hora", $hora);
    $stmt->bindParam(":local", $local);
    $stmt->bindParam(":descricao", $descricao);

    if ($stmt->execute()) {
        echo "<script>
            alert('Compromisso atualizado com sucesso');
            window.location.href='../views/compromissos.php';
        </script>";
    }
}
    
    public function ExcluirCompromisso($id)
    {
    $sql = "DELETE FROM compromissos WHERE id_compromissos = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
    }

   public function listarPorPeriodo($inicio, $fim, $usuario_idfk)
    {
    $sql = "SELECT * FROM compromissos WHERE data_compromisso BETWEEN :inicio AND :fim AND usuario_idfk = :usuario
            ORDER BY data_compromisso, hora_compromisso";

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fim', $fim);
    $stmt->bindParam(':usuario', $usuario_idfk);

    if($stmt->execute())
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];
    }

    public function proximosCompromissos($usuarios_idfk)
    {
    $sql = "SELECT * FROM compromissos WHERE usuario_idfk = :usuarios
            AND data_compromisso >= CURRENT_DATE ORDER BY data_compromisso ASC, hora_compromisso ASC LIMIT 5";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":usuarios", $usuarios_idfk);

    if ($stmt->execute()) 
        {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    return []; 
    }
    

   public function BuscarCompromissos($texto, $usuario_idfk)
    {
    $sql = "SELECT * FROM compromissos
            WHERE usuarios_idfk = :usuario AND (titulo LIKE :texto OR local_compromisso LIKE :texto OR descricao LIKE :texto)
            ORDER BY data_compromisso ASC";

    $stmt = $this->pdo->prepare($sql);

    $texto = "%".$texto."%";

    $stmt->bindParam(":texto", $texto);
    $stmt->bindParam(":usuario", $usuario_idfk);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>