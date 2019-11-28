<?php
session_start();
require_once('../../models/Usuario.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use controllers\ControllerProspect;
use models\Usuario;
$girafa=0;
function codigo($x){
    echo $x;
    $girafa = $x;
    header("Location: ../../controllers/Prospect/c_excluir_prospect.php?codigo=".$girafa.'"');


}

if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../../libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style type="text/css">
            .table-overflow {
                max-height:600px;
                overflow-y:auto;
            }
        </style>
    </head>
    <body>
            <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmação de Exclusão</h4>
        </div>
        <div class="modal-body">
          <p>Deseja realmente excluir o prospect?.</p>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Excluir</button>  
        </div>
      </div>
      </div>
      
    </div>
  </div>
        <header>
        
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse" id="textoNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link " href="../main.php">Home <span class="sr-only">(Página atual)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cadastrar Prospects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/sair.php">Sair</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        Bem vindo: <?php $usuario = unserialize($_SESSION['usuario']);
                    echo $usuario->nome;
                    ?>
                    </span>
                </div>
            </nav>
        </header><br>
        <div class="container">
            <div class="table-overflow" style= "height: 750; overflow: auto;">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Facebook</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ctrProspect = new ControllerProspect();
                            $listarProspects = $ctrProspect->buscarProspects();
                            foreach($listarProspects as $prospect){
                                echo '<tr>';
                                    echo '<td>'.$prospect->nome.'</td>';
                                    echo '<td>'.$prospect->email.'</td>';
                                    echo '<td>'.$prospect->celular.'</td>';
                                    echo '<td>'.$prospect->facebook.'</td>';
                                    echo '<td>'.$prospect->whatsapp.'</td>';
                                    echo '<td width="150"><a href="v_alterar_prospect.php?email='.$prospect->email.'">alterar</a> |
                                    <a data-toggle="modal" data-target="#myModal" href="?codigo='.$prospect->codigo.'">excluir</a></td>' ;
                                    echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <a class="btn btn-primary" href="v_incluir_prospect.php">Novo</a>
            </div>
        </div>
               
    </body>
    
</html>

<?php
}else{
    $_SESSION['erroLogin'] ="Faça o login para acessar o sistema!";
    header("Location: ../../index.php");
}
?>