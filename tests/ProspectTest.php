<?php
namespace test;
require_once('../vendor/autoload.php');
require_once('../models/Prospect.php');
use PHPUnit\Framework\TestCase;
use models\Prospect;

class ProspectTest extends TestCase{

   /** @test */
   public function incluirProspect(){
      $prospect = new Prospect();
      $this->assertEquals(
         TRUE,
         $prospect->incluirProspect('Paulo Roberto Cordova', 'paulo@eu.com.br', '(49)96633-9988', 'facepaulo', '(49)8899-6699')
      );

      unset($prospect);
   }
   /** @test */
   public function atualizarProspect(){
      $prospect = new Prospect();
      $this->assertEquals(
         TRUE,
         $prospect->atualizarProspect('Paulo Roberto Cordova', 'paulo@gmail.com.br', '(49)96633-9988',  'facepaulo', '(49)8899-6699', 3)
      );
      unset($prospect);
   }
   /** @test */
   public function excluirProspect(){
      $prospect = new Prospect();
      $this->assertEquals(
         TRUE,
         $prospect->excluirProspect(2)
      );
      unset($prospect);
   }
   /** @test */
   public function buscarTodosProspectTest(){
      $prospect = new Prospect();
      $arrayComparar = array();

      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      $sqlBusca = $conn->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect");
      $sqlBusca->execute();
      $result = $sqlBusca->get_result();
      if($result->num_rows !== 0){
         while($linha = $result->fetch_assoc()) {
            $linhaComparar = array(
               "codProspect" => $linha['cod_prospect'],
               "nome" => $linha['nome'],
               "email" => $linha['email'],
               "celular" => $linha['celular'],
               "facebook" => $linha['facebook'],
               "whatsapp" => $linha['whatsapp']
            );
            $arrayComparar[] = $linhaComparar;
         }
      }

      $this->assertEquals(
         $arrayComparar,
         $prospect->buscarProspects()
      );
      unset($prospect);
      $sqlBusca->close();
      $conn->close();
   }
   /** @test */
   public function buscarProspectPorEmailTest(){
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
               "celular" => $linha['celular'],
               "facebook" => $linha['facebook'],
               "whatsapp" => $linha['whatsapp']
            );
            $arrayComparar[] = $linhaComparar;
         }
      }

      $this->assertEquals(
         $arrayComparar,
         $prospect->buscarProspects($emailProspect)
      );
      unset($prospect);
      $sqlBusca->close();
      $conn->close();
   }
}
?>