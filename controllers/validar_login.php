<?php
session_start();
require_once('Usuario/ControllerUsuario.php');
use controllers\ControllerUsuario;
if(isset($_POST['login']) && isset($_POST['senha'])){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $ctrUsuario = new ControllerUsuario();
    $usuario = $ctrUsuario->fazerLogin($login, $senha);

    if($usuario->logado){
        $_SESSION['usuario'] = serialize($usuario);
        header("Location: ../views/main.php");
    }
}else{
    $_SESSION['erroLogin'] = "Você precisa fazer login para acessar o sistema!";
    header("Location: ../index.php");
}
?>