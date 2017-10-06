
<?php

    require_once "autoload.php";
    $usuarioService = new UsuarioService();
    $usuarioService->verificaUsuario();

    require_once "conecta.php";

    $categoriaDao = new CategoriaDao($conexao);
    $categorias = $categoriaDao->lista();
    
    $produto = new Produto();
    $produto->setCategoria(new Categoria());

    $action = 'adiciona-produto.php';
    $ehAlteracao = false;
    $usado = '';
    if (isset($_REQUEST['id'])) {
        $action = 'altera-produto.php';
        $ehAlteracao = true;
        $produtoDao = new ProdutoDao($conexao);
        $produto = $produtoDao->busca($_REQUEST['id']);
        $usado = $produto->getUsado()?"checked":"";
    }

?>

<?php require_once "includes/cabecalho.php"; ?>
    
<div Class="jumbotron">

    <h2><?=$ehAlteracao?"Alterando":"Incluindo"?></h2>
    
    <br>
    
    <form action="<?=$action?>" method="POST">
        <input type="hidden" name="id" value="<?=$produto->getId()?>">
        <div class="form-group">
            <label for="">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?=$produto->getNome()?>">
        </div>

        <div class="form-group">
            <label for="">Preço</label>
            <input type="number" name="preco" class="form-control" value="<?=$produto->getPreco()?>">
        </div>   

        <div class="form-group">
            <label for="">Descriçao</label>
            <textarea name="descricao" class="form-control"><?=$produto->getDescricao()?></textarea>
        </div>  

        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="usado" <?=$usado?> > Usado
            </label>
            
        </div>

        
        <div class="form-group">
            <label for="">Categorias</label>
            <select class="form-control" name="categoria_id" id="">
                <?php foreach($categorias as $categoria){
                    $select= $categoria->getId()==$produto->getCategoria()->getId()?"selected":"";   
                ?>
                
                    <option value="<?=$categoria->getId()?>" <?=$select?>>  <?=$categoria->getNome()?>  </option>

                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="">Tipo de produto</label>
            <select name="tipoProduto" class="form-control" id="">
                    <option value="geral" <?=!$produto->temIsbn() ? "selected" : ""?>>Geral</option>
                    <option value="livro" <?=$produto->temIsbn() ? "selected" : ""?>>Livro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">ISBN (opcional)</label>
            <?php if ($produto->temIsbn()) {
                $isbn= $produto->getIsbn();
            } else {
                $isbn="";
            } ?>

            <input class="form-control" name="isbn" value="<?=$isbn?>">

        </div>

        <input type="submit" value="Salvar" class="btn btn-primary">
    </form>
</div>

<?php require_once "includes/rodape.php"; ?>