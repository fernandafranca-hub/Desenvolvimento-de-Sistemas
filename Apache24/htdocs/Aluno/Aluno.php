<?php
    class Aluno
    {
        private string $nome;
        private string $email;

        public function cadastrarAluno($nomeAluno, $emailAluno)
        {
            $this->nome = $nomeAluno;
            $this->email = $emailAluno;

            require_once("Connect.php");
            $obj = new Connect();
            $pdo = $obj->conectarBanco();

            $sql = "INSERT INTO alunos (nome, email) VALUES (:nome, :email);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome',$this->nome);
            $stmt->bindValue(':email',$this->email);

            if($stmt->execute())                
                return TRUE;
                
            else
               return FALSE;                
        }

        public function listarAlunos()
        {
            require_once("Connect.php");
            $obj = new Connect();
            $pdo = $obj->conectarBanco();

            $sql = "SELECT * FROM alunos;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $tuplas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $tuplas;
        }
    }
?>