<?php
session_start();

require_once('ControllerUsuario.php');
use controllers\ControllerUsuario;

$nome = $_POST['nome'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];

$cUsuario = new ControllerUsuario();
try{
   $cUsuario->salvarUsuario($nome, $email, $login, $senha);
   unset($cUsuario);
    $_SESSION['erroLogin'] = "Faça o Login para entrar no sistema!";
   header("Location: ../../index.php");
}catch(Exception $e){
   $_SESSION['erroNovoUsuario'] = $e->getMessage();
   unset($cUsuario);
   header("Location: ../../views/Usuario/v_incluir_usuario.php");
}
?>
