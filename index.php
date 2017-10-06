
<?php 
    require_once "includes/cabecalho.php"; 
    require_once "autoload.php";
    $usuarioService = new UsuarioService();
    
?>


<?php
    if(array_key_exists('login', $_REQUEST)){
        if($_REQUEST['login']==false){
?>
        <p class="text-center alert alert-danger msg">Usuario ou senha inválido</p>
<?php
        }
    }
?>


<?php if(isset($_REQUEST['falhaDeSeguranca'])){ ?>
    <p class="text-center alert alert-danger msg">Por favor faça o login do usuário.</p>
<?php } ?>

<?php if(isset($_REQUEST['logout'])){ ?>
    <p class="text-center alert alert-danger msg">Usuario deslogado</p>
<?php } ?>


<?php 
    if($usuarioService->usuarioEstaLogado()) {
?>  
    <br>

    <div class="container-fluid alert alert-success">
        <h2 class="text-center">Voce esta logado como <?=$usuarioService->usuarioLogado()?>.</h2>
    </div>

    <br>
    <p class="text-center text-danger"> <a href="logout.php">Deslogar</a></p>

<?php } else { ?>
    
    <h1 class="text-center">Seja bem vindo</h1>
    <br>
    <div class="jumbotron">
        <h2>Login:</h2>

        <br>
        <form action="login.php" method="POST">
        <div class="form-group">
            <label for="">Usuário:</label>
            <input class="form-control" type="text" name="login">
        </div>    

        <div class="form-group">
            <label for="">Senha:</label>
            <input class="form-control" type="password" name="senha">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
    
<?php } ?>


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