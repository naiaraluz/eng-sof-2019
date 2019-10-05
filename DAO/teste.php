<?php
require_once('DAOUsuario.php');
use DAO\DAOUsuario;
$daoUsuario - new DAOUsuario();
    print_r($daoUsuario->logar('paulo', '123'));
?>