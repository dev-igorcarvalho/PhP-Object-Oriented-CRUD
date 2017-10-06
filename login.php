<?php


require_once "conecta.php";
require_once "autoload.php";
$usuarioService = new UsuarioService();

$login = $_POST['login'];
$senha = $_POST['senha'];

$usuarioDao = new UsuarioDao($conexao);
if ($usuarioDao->busca($login, $senha)){
    $usuarioService->logaUsuario($login);
    header('location:index.php?login=1');
} else {
    header('location:index.php?login=0');
}
    
die();
?>

