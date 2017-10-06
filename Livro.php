<?php

require_once "autoload.php";

class Livro extends Produto {
    private $isbn;

    //polymorph de funcao q usa atributo private
    function calculaImposto () {
        return $this->getPreco()*0.05;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function setIsbn($isbn) {
        $this->isbn=$isbn;
    }
}
