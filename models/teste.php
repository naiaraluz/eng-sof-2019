<?php
require_once('Prospect.php');
use models\Prospect;

$prospect = new Prospect();
$arrayComparar = array();

$emailProspect = 'gernunes@hotmail.com';

$conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
$sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                    facebook, whatsapp
                                    from prospect
                                    where
                                    email = '$emailProspect'");

$sqlBusca->execute();
$result = $sqlBusca->get_result();
if($result->num_rows !== 0){
   while($linha = $result->fetch_assoc()) {
      $linhaComparar = array(
         "codProspect" => $linha['cod_prospect'],
         "nome" => $linha['nome'],
         "email" => $linha['email'],
         "celular" => $linha['celular']
      );
      $arrayComparar[] = $linhaComparar;
   }
}
$arrProspects = $prospect->buscarProspects($emailProspect);
print_r($arrayComparar);
echo "<hr>";
print_r($arrProspects);


unset($prospect);

?>