

<?php
require_once "conecta.php"; 
require_once "autoload.php";

$usuarioService = new UsuarioService();
$usuarioService->verificaUsuario();

$produtoDao = new ProdutoDao($conexao);
$produtos = $produtoDao->lista();
?>

<?php require_once "includes/cabecalho.php"; ?>


<h1 class="text-center">Listagem de produtos</h1>
<br>

<!-- alerta remove -->
<?php 
    if(array_key_exists('removido',$_REQUEST)) { 
        if($_REQUEST['removido']=='true') {
?>
            <p class="alert alert-info msg">Produto removido com sucesso.</p>

<?php } else { ?>
            <p class="alert alert-info msg">Produto não removido.</p>
<?php            
     }
    }
?>

<!-- alerta adiciona -->
<?php 
    if(array_key_exists('adicionado',$_REQUEST)) { 
        if($_REQUEST['adicionado']=='true') {
?>
        <p class="alert alert-info msg">Produto adicionado com sucesso.</p>

<?php } else { ?>

        <p class="alert alert-danger msg"> Não foi possível adicionar o produto </p>

<?php            
     }
    }
?>

<!-- alerta altera -->
<?php 
    if(array_key_exists('alterado',$_REQUEST)) { 
        if($_REQUEST['alterado']=='true') {
?>
        <p class="alert alert-info msg">Produto alterado com sucesso.</p>

<?php } else { ?>

        <p class="alert alert-danger msg"> Não foi possível alterar o produto </p>

<?php            
     }
    }
?>

<br>
<div class="table-responsive">

    <table class="table table-hover">

        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Imposto</th>
            <th>ISBN</th>
            <th></th>
            <th></th>
        </tr>

        <?php foreach($produtos as $produto){ ?>
            
        <tr>

            <td><?=$produto->getNome()?></td>
            <td>R$ <?=$produto->getPreco()?></td>
            <td><?=substr($produto->getDescricao(), 0,40)?></td>
            <td><?=$produto->getCategoria()->getNome()?></td>
            
            <td>R$ <?=$produto->calculaImposto()?></td>

            <td>
                <?php if($produto->temIsbn()){ ?>
                       ISBN <?=$produto->getIsbn()?>
            <?php  } ?>
            </td>

            <td>
                <form action="remove-produto.php" method="POST">
                    <input type="hidden" name="id" value="<?=$produto->getId()?>">
                    <button type= submit class="btn btn-danger">Remove</button>
                </form>
            </td>

            <td>
                <a class="btn btn-default" href="produto-formulario.php?id=<?=$produto->getId()?>">
                Alterar</a>
            </td>
            
        </tr>

        <?php } ?>

    </table>

</div>
    
<script>
    [...document.querySelectorAll('table tr .remove')]
    .forEach(a=>a.onclick=event=>{
        if (!confirm('Confirma?')){
            event.preventDefault();
        };
    });
    setTimeout(()=>document.querySelector('.msg').remove(),5000);
</script>    
<?php require_once "includes/rodape.php"; ?>