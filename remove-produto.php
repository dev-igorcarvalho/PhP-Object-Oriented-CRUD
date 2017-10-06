
<?php

    require_once "conecta.php";
    require_once "autoload.php";
    $id = $_REQUEST['id'];

    $produtoDao = new ProdutoDao($conexao);
    if($produtoDao->remove($id)) { 
        header('Location:produto-lista.php?removido=true');
    } else {
        header('Location:produto-lista.php?removido=false');
    }

die()
                                        
?>