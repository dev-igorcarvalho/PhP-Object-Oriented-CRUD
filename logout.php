<?php 

    require_once "autoload.php";
    $usuarioService = new UsuarioService();
    $usuarioService->logOut();
    header('location:index.php?logout=true');
    die();


?>