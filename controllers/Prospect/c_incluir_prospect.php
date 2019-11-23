<?php
session_start();

$separador = DIRECTORY_SEPARATOR;
$directorioBASE = dirname(__FILE__).$separador;

$separador = DIRECTORY_SEPARATOR;
$root = $_SERVER['DOCUMENT_ROOT'].$separador;

require_once('ControllerProspect.php');
require_once($root.'prospectcolector/models/Prospect.php');

use models\Prospect;
use controllers\ControllerProspect;

if (isset($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];

    if (strpos($email, '#') !== false) {
        $_SESSION['erroNovoProspect'] = 'Email não pode conter "#"';
        header('Location: ../../views/Prospect/v_incluir_prospect.php');
        return;
    }
    if (strpos($email, '@') === false) {
        $_SESSION['erroNovoProspect'] = 'Email precisa ter "@"';
        header('Location: ../../views/Prospect/v_incluir_prospect.php');
        return;
    }

    $prospect = new Prospect();
    $prospect->addProspect(null, $nome, $email, $celular, $facebook, $whatsapp);

    $ctrlProspect = new ControllerProspect();
    
    try{
        $ctrlProspect->salvarProspect($prospect);
        unset($prospect);
        unset($ctrlProspect);
        header('Location: ../../views/Prospect/v_listar_prospect.php');

    }catch(\Exception $e){
        $_SESSION['erroNovoProspect'] = $e->getMessage();
        unset($prospect);
        unset($ctrlProspect);
        header('Location: ../../views/Prospect/v_incluir_prospect.php');
    }
}
?>