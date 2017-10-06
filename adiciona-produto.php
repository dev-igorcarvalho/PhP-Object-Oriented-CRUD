<?php 
    require_once "autoload.php";

    $usuarioService = new UsuarioService();
    $usuarioService->verificaUsuario();

    require_once "conecta.php";
    
    if (strcasecmp($_REQUEST['tipoProduto'], 'livro')==0) {
        $produto = new Livro();
        $produto->setIsbn($_REQUEST['isbn']);
    } else {
        $produto = new Produto();
    }

    $produto->setNome($_REQUEST['nome']);
    $produto->setPreco($_REQUEST['preco']);
    $produto->setDescricao($_REQUEST['descricao']);

    $categoria = new Categoria();
    $categoria->setId($_REQUEST['categoria_id']);

    $produto->setCategoria($categoria);
    $produto->setUsado("false");

    if(array_key_exists('usado', $_REQUEST)) {
        $produto->setUsado("true");
    }
 
    $produtoDao = new ProdutoDao($conexao); 
?>

    <?php if($produtoDao->insere($produto)) {
        header('Location:produto-lista.php?adicionado=true');
    } else { 
        $msg=mysqli_error($conexao);
        error_log($msg, 0);
        header('Location:produto-lista.php?adicionado=false'); 
    } ?>
