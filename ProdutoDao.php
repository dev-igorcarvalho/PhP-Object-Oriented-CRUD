<?php
require_once "autoload.php";

class ProdutoDao {
    private $conexao;

    function __construct($conexao){
        $this->conexao=$conexao;
    }

    function lista(){
        $produtos = array();
        $query = "SELECT p.*, c.nome AS categoria_nome FROM produtos AS p JOIN categorias AS c ON p.categoria_id = c.id";
        $result = mysqli_query($this->conexao, $query);
        error_log(mysqli_error($this->conexao));

        while($array = mysqli_fetch_assoc($result)){

            if (trim($array['isbn'])!=="") {
                $produto = new Livro();
                $produto->setIsbn($array['isbn']);
            } else {
                $produto = new Produto();
            }

            $produto->setId($array['id']);
            $produto->setNome($array['nome']);
            $produto->setPreco($array['preco']);
            $produto->setDescricao($array['descricao']);
            $produto->setUsado($array['usado']);

            $categoria = new Categoria();
            $categoria->setId($array['categoria_id']);
            $categoria->setNome($array['categoria_nome']);
            $produto->setCategoria($categoria);

            array_push($produtos,$produto);
        }

        return $produtos;
    }

    function insere($produto){
        if ($produto->temIsbn()){
            $isbn=$produto->getIsbn();
        } else {
            $isbn="";
        }
        $query = "INSERT INTO produtos(nome, preco, descricao, categoria_id, usado, isbn) values (
                                '{$produto->getNome()}',
                                 {$produto->getPreco()},
                                '{$produto->getDescricao()}',
                                 {$produto->getCategoria()->getId()},
                                 {$produto->getUsado()}, 
                                 '{$isbn}')";
        $result = mysqli_query($this->conexao, $query);
        error_log(mysqli_error($this->conexao));
        return $result;
    }

    function remove($id){
        $query = "DELETE FROM produtos WHERE id={$id}";
        $result = mysqli_query($this->conexao, $query);
        error_log(mysqli_error($this->conexao));
        return $result;
    }

    function busca($id){
        $query = "SELECT p.*, c.nome AS categoria_nome FROM produtos AS p JOIN categorias AS c ON p.categoria_id = c.id WHERE p.id={$id}";
        $result = mysqli_query($this->conexao, $query);
        error_log(mysqli_error($this->conexao));
        $array = mysqli_fetch_assoc($result);

        if (trim($array['isbn'])!=="") {
            $produto = new Livro();
            $produto->setIsbn($array['isbn']);
        } else {
            $produto = new Produto();
        }

        $produto->setId($array['id']);
        $produto->setNome($array['nome']);
        $produto->setPreco($array['preco']);
        $produto->setDescricao($array['descricao']);
        $produto->setUsado($array['usado']);

        $categoria = new Categoria();
        $categoria->setId($array['categoria_id']);
        $categoria->setNome($array['categoria_nome']);
        $produto->setCategoria($categoria);

        return $produto;
    }

    function altera($produto){

        if ($produto->temIsbn()){
            $isbn=$produto->getIsbn();
        } else {
            $isbn="";
        }

    $query = "UPDATE produtos SET nome='{$produto->getNome()}', 
                                preco={$produto->getPreco()}, 
                                descricao='{$produto->getDescricao()}', 
                                categoria_id={$produto->getCategoria()->getId()}, 
                                usado={$produto->getUsado()},
                                isbn='{$isbn}' WHERE id={$produto->getId()}";

        $result = mysqli_query($this->conexao, $query);
        error_log(mysqli_error($this->conexao));
        
        return $result;
        
    }

}