<?php
class Produto
{
    private string $nome;
    private float $preco;
    private int $quantidade;
    private string $descricao;

    public function cadastrarProduto($nomeProduto, $precoProduto, $quantidadeProduto, $descricaoProduto)
    {
        $this->nome = $nomeProduto;
        $this->preco = $precoProduto;
        $this->quantidade = $quantidadeProduto;
        $this->descricao = $descricaoProduto;

        require_once("Connect_mercado.php");
        $obj = new Connect_mercado();
        $pdo = $obj->conectarBanco();

        $sql = "INSERT INTO produto(nome, preco, quantidade, descricao) VALUES(:nome, :preco, :quantidade, :descricao);";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':preco', $this->preco);
        $stmt->bindValue(':quantidade', $this->quantidade);
        $stmt->bindValue(':descricao', $this->descricao);


        if($stmt->execute())
            return TRUE;
        else
            return FALSE;
    }

    public function listarProdutos()
    {
        require_once("Connect_mercado.php");

        $obj = new Connect_mercado();
        $pdo = $obj->conectarBanco();

        $sql = "SELECT * FROM produto;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $tuplas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tuplas;
    }
}
?>