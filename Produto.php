<?php 

    
    class Produto {
        private $id;
        private $nome;
        private $descricao;
        private $preco;
        private $usado;
        private $categoria;
        
        function subtraiDesconto ($taxa=0.05) {
           
            if ($taxa > 0 && $taxa < 1) {
            $desconto = $taxa * $this->preco;
            $this->preco -= $desconto;
            }
            return $this->preco;
        } 

        function calculaImposto () {
            return $this->preco*0.1;
        }


        function toDto(){
            $dto = new stdClass();
            $dto->id = $this->id;
            $dto->nome = $this->nome;
            $dto->descricao = $this->descricao;
            $dto->preco = $this->preco;
            $dto->usado = $this->usado;
            return $dto;
        }
        
        
        function getId() {
            return $this->id;
        }

        function setId($id) {
            $this->id = $id;
        }

        function getNome() {
            return $this->nome;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        function getPreco() {
            return $this->preco;
        }

        function setPreco($preco) {
            $this->preco = $preco;
        }

        function getUsado() {
           return $this->usado;
        }

        function setUsado($usado) {
            $this->usado = $usado;
        }

        function getCategoria() {
           return $this->categoria;
        }

        function setCategoria($categoria) {
            $this->categoria = $categoria;
        }

        function __toString(){
            return $this->nome;
        }

        function temIsbn(){
            return $this instanceof Livro;
        }

      }

?>