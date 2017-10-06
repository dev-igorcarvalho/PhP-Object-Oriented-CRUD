<?php 
    session_start();

    class UsuarioService {
    

        function verificaUsuario(){
                if (!$this->usuarioEstaLogado()) {
                    header('location:index.php?falhaDeSeguranca=true');
                    die();
                }
            }

        function usuarioEstaLogado() {
        return isset($_SESSION['usuario_logado']);
        }

        function usuarioLogado() {
            return $_SESSION['usuario_logado'];
        }

        function logaUsuario($login){
            $_SESSION['usuario_logado']=$login;
        }

        function logOut() {
            session_destroy();
        }
    }
?>