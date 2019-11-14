<?php
session_start();
require_once('../../controllers/Prospect/ControllerProspect.php');
require_once('../../models/Usuario.php');

use models\Usuario;
use controllers\ControllerProspect;

if(isset($_SESSION['usuario'])){
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $ctrlProspect = new ControllerProspect();
        $arrayProspect = $ctrlProspect->buscarProspects($email);

        $prospect = $arrayProspects[0];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="textoNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../main.php">Home <span class="sr-only">(Página atual)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cadastrar Prospects</a>
                    </li>
                </ul>
                <span class="navbar-text">
                        Bem vindo: <?php $usuario = unserialize($_SESSION['usuario']);
                    echo $usuario->nome;
                    ?>
                </span>
            </div>
        </nav>
        </header>
        <div class="container">
            <form class="form-signin" action="../../controllers/usuario/c_alterar_usuario.php" method="POST">
                <div>
                    <h5 class="form-signin-heading">Alterar Prospect:</h5>
                </div class="">
                <div class="form-group">
                     <label for="codigo">Código:</label>
                     <input name="codigo" id="nome" type="text" class="form-control" required readonly/>
                     <label for="nome">Nome:</label>
                     <input name="nome" id="nome" type="text" placeholder="Digite seu nome" class="form-control" required/>
                     <label for="email">E-mail:</label>
                     <input name="email" id="email" placeholder="Digite seu E-mail" class="form-control" required autofocus autocomplete="off"/>
                     <label for="celular">Celular:</label>
                     <input name="celular" id="celular" type="text" placeholder="Digite seu celular" class="form-control" required/>
                     <label for="whatsapp">Whatsapp:</label>
                     <input name="whatsapp" id="whatsapp" type="text" placeholder="Digite seu whatsapp" class="form-control" required/>
                     <label for="facebook">Facebook:</label>
                     <input name="facebook" id="facebook" type="text" placeholder="Digite sua facebook" class="form-control" required/>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="v_listar_prospect.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Você precisa estar logado para executar esta operação!";
    header("Location: ../../index.php");
}
?>