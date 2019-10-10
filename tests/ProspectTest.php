<?php
namespace test;
require_once('../vendor/autoload.php');
require_once('../models/Prospect.php');
require_once('../DAO/DAOProspect.php');
use PHPUnit\Framework\TestCase;
use models\Prospect;

class ProspectTest extends TestCase{

   /** @test */
   public function incluirProspect(){
      $daoprospect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoprospect->incluirProspect('Paulo Roberto Cordova', 'paulo@eu.com.br', '(49)96633-9988', 'facepaulo', '(49)8899-6699')
      );

      unset($daoprospect);
   }
   /** @test */
   public function atualizarProspect(){
      $daoprospect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoprospect->atualizarProspect('Paulo Roberto Cordova', 'paulo@gmail.com.br', '(49)96633-9988',  'facepaulo', '(49)8899-6699', 3)
      );
      unset($daoprospect);
   }
   /** @test */
   public function excluirProspect(){
      $daoprospect = new DAOProspect();
      $this->assertEquals(
         TRUE,
         $daoprospect->excluirProspect(2)
      );
      unset($daoprospect);
   }
   /** @test */
   public function buscarTodosProspectTest(){
      $daoprospect = new DAOProspect();
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
         $daoprospect->buscarProspects()
      );
      unset($daoprospect);
      $sqlBusca->close();
      $conn->close();
   }
   /** @test */
   public function buscarProspectPorEmailTest(){
      $daoprospect = new Prospect();
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
         $daoprospect->buscarProspects($emailProspect)
      );
      unset($daoprospect);
      $sqlBusca->close();
      $conn->close();
   }
}
?>