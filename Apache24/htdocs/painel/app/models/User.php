<?php

class User 
{
    private string $login;
    private string $password;
    private $pdo;

    public function __construct()
    {
        include_once ("Connect.php");
        $conexao = new Connect(); 
        $this->pdo =  $conexao->conectarBanco();      
    }

    
    public function ValidarLogin($email, $senha)
    {
        $this->login = $email;
        $this->password = $senha;

        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND ativo = TRUE;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email',$this->login);
        $stmt->bindParam(':senha',$this->password);
        $stmt->execute();

        $vetor = $stmt->fetch(PDO::FETCH_ASSOC);
        if(isset($vetor["email"]) && isset($vetor["senha"]))
            {
                return(TRUE);
            }
            else
                {
                return(FALSE);
                }


    }
    public function ListarTodosUsuarios()
    {
        $sql = "SELECT * FROM usuarios ORDER BY id_usuarios ASC;";
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
    public function ListarUmUsuario($id_usuarios)
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuarios = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_usuarios);        
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

    public function EditarUsuario($id_usuario, $email)
    {
        $sql = "UPDATE usuarios SET email = :email WHERE id_usuarios = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_usuario);
        $stmt->bindParam(':email', $email);
            if($stmt->execute())
            {
                echo '<script>                    

                    alert("Usuário atualizado com sucesso.");
                    window.location.href="http://localhost/painel/app/views/listar_usuario.php";
                    </script>'; 
            }
            else 
            {
                echo "Erro";
            }                                       
                
    }
            
    public function ExcluirUsuario($id_usuario)
    {
        $sql = "DELETE FROM usuarios WHERE id_usuarios = :id;";    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_usuario);
            if($stmt->execute())
            {
             echo '<script>                    
                alert("Usuário excluído com sucesso.");
                window.location.href="http://localhost/painel/app/views/listar_usuario.php";
              </script>'; 
            }
            else 
            {
            echo "Erro ao excluir usuario";
            } 
    }    
    
    public function CadastrarUsuario($email, $senha)
    {
        $this->login = $email;
        $this->password = $senha;

        $sql = "INSERT INTO usuarios(email, senha, ativo) VALUES(:email, :senha, 'true');";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email',$this->login);
        $stmt->bindParam(':senha',$this->password);
        //$stmt->execute();

        //$vetor = $stmt->fetch(PDO::FETCH_ASSOC);
       // if(isset($vetor["email"]) && isset($vetor["senha"]))
            if($stmt->execute())
            {
                echo '<script>                    

                    alert("Usuário cadastrado com sucesso.");
                    window.location.href="http://localhost/painel/app/views/listar_usuario.php";
                    </script>'; 
            }
            else 
            {
                echo "Email não disponível";
            } 
    }                     
}
?>