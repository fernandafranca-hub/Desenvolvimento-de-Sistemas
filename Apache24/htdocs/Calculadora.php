<?php
class Calculadora
{
    private $num1;
    private $num2;
    private $resultado;

    public function setSoma($A, $B)
    {
        $this->resultado = $A+$B;
    }

     public function setSubtracao($A, $B)
    {
        $this->resultado = $A-$B;
    }

     public function setMultiplicacao($A, $B)
    {
        $this->resultado = $A*$B;
    }

     public function setDivisao($A, $B)
    {
         if ($B==0)
            {
                echo ("A operação é invalida");
            }
            else
                {
                     $this->resultado = $A/$B;
                }
    }
    public function getResultado()
    {
        return "O resultado é: ".$this->resultado;
    }        
       
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form method="post" action="Calculadora.php">
        <label>Valor 1</label>
        <input type="number" name="num1" require />
        <br />
        <label>Valor 2</label>
        <input type="number" name="num2" require />
        <br />
        <input type="submit" name = "somar" value = "Somar" />
        <input type="submit" name = "subtrair" value = "Subtrair" />
        <input type="submit" name = "dividir" value = "Dividir" />
        <input type="submit" name = "multiplicar" value = "Multiplicar" />
        </form>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $minhaCalculadora = new Calculadora();

        if(isset($_POST["somar"]))
        {
            $minhaCalculadora->setSoma($_POST["num1"], $_POST["num2"]);
            echo $minhaCalculadora->getResultado();
        }
        
        if(isset($_POST["subtrair"]))
       {
        $minhaCalculadora->setSubtracao($_POST["num1"], $_POST["num2"]);
        echo $minhaCalculadora->getResultado();
       }
        
        if(isset($_POST["dividir"]))
        {
            $minhaCalculadora->setDivisao($_POST["num1"], $_POST["num2"]);
            echo $minhaCalculadora->getResultado();
        }
        
        if(isset($_POST["multiplicar"]))
        {
            $minhaCalculadora->setMultiplicacao($_POST["num1"], $_POST["num2"]);
            echo $minhaCalculadora->getResultado();
        }
    
}

    
