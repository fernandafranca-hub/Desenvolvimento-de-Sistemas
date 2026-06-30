<?php
class ContaBancaria
{
    private $Usuario;
    private $SaldoInicial;
   
    public function setAbrirConta($users)
    {
        $this->Usuario = $user;
        $this->SaldoInicial = 1000.00;
    }

    public function setSacar($user, $Valor)
    {

        if($this->Saldo >= $Valor)
        {
            $this->usuario = $user;
            $this->saldo -+$valor;
             Return "Saque realizado com sucesso"; 
        }
        else
        {
            return ("Saque realizado com sucesso");
        }
    }
    public function setDepositar($user, $Valor)
    {    
        $this->usuario = $user;
        $this->SaldoInicial= $this->SaldoInicial + Valor;
        
        return ("Deposito realizado com sucesso");      
    }

    public function getConsultarSaldo ()
    {
        return "O Titular da conta é: ".$this->Usuario."<br />".        
        "O saldo da conta é: ".$this->Saldo."<br />";      
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Bancaria</title>
</head>
<body>
    <form method="post" action="ContaBancaria.php">
    <label>Usuario</label>
    <input type="text" name="user"  require />
    <br /> 
    <label>Valor</label>
    <input type="text" name="Valor" require />
    <br />
    <input type="submit" name = "Sacar" value = "sacar" />
    <input type="submit" name = "Depositar" value = "depositar" />
    </form>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $minhaConta = new ContaBancaria()
    $minhaConta->setAbrirConta($_POST["user"]);

    if(isset($_POST["sacar"]))
        {
        $minhaConta->setSacar($_POST["user"], $_POST["valor"]);
            }
            else
                {
                    echo $minhaConta->setDepositar($_POST["user"], $_POST["valor"]);
                }
                echo $minhaConta->getConsultarSaldo();
    }
?>
