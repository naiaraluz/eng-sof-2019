<?php
session_start();

require_once('ControllerProspect.php');
require_once('../../models/Prospect.php');

use models\Prospect;
use controllers\ControllerProspect;

if(isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];

    $prospect = new Prospect();
    $prospect->addProspect($codigo, $nome, $email, $celular, $facebook, $whatsapp);

    $ctrlController = new ControllerProspect();

    try {
        $ctrlController->salvarProspect($prospect);
        header('Location: ../../views/Prospect/v_listar_prospect.php');

    } catch(\Exception $ex) {
        $_SESSION['erroAlteracao'] = $ex->getMessage();
        header('Location: ../../views/Prospect/v_alterar_prospect.php?email='.$_SESSION['emailAtual']);
    }
} else {
    $_SESSION['erroLogin'] = 'Faça o Login para completar a operação!';
    header('Location: ../../index.php');
}
?>