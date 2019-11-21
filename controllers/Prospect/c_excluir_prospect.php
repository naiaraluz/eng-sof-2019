<?php

session_start();
require_once('ControllerProspect.php');
require_once('../../models/Prospect.php');

use models\Prospect;
use controllers\ControllerProspect;

if(isset($_GET ['codigo'])){
    $codigo = $_GET['codigo'];

    $prospect = new Prospect();
    $prospect->addProspect($codigo, '', '', '', '', '');

    $ctrlProspect = new ControllerProspect();
    $ctrlProspect->excluirProspect($prospect);

    unset($prospect);
    unset($ctrlProspect);

    header("Location: ../../views/Propect/v_listar_prospect.php");
}else{
    $_SESSION['erroLogin'] = "Faça o Login para completar a operação!";
    header("Location: ../index.php");
}
?>