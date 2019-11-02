<?php
session_start();
require_once('ControllerUsuario.php');
use controllers\ControllerUsuario;

if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['email']) && isset($_POST['nome'])){
   $login = $_POST['login'];
   $senha = $_POST['senha'];
   $nome = $_POST['nome'];
   $email = $_POST['email'];

   $ctrlUsuario = new ControllerUsuario();
   try {
      $ctrlUsuario->salvarUsuario($nome, $email, $login, $senha);
      header("Location: ../../views/main.php");

   }catch(\Exception $e){
      header("Location: ../../views/main.php");
   }

}else{
   $_SESSION['erroLogin'] = "Você precisa fazer login para acessar o sistema";
   header("Location: ../../index.php");
}
?>