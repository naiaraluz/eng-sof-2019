<?php
namespace test;
require_once('../vendor/autoload.php');
require_once('../models/Usuario.php');
require_once('../DAO/DAOUsuario.php');
use PHPUnit\Framework\TestCase;
use models\Usuario;
use DAO\DAOUsuario;

class UsuarioTest extends TestCase{

   /** @test */
   public function testLogar(){
      $daousuario = new DAOUsuario();
      $this->assertEquals(
         TRUE,
         $daousuario->logar('paulo', '123')
      );

      unset($daousuario);
   }
   /** @test */
   public function testIncluirUsuario(){
      $daousuario = new DAOUsuario();
      $this->assertEquals(
         TRUE,
         $daousuario->incluirUsuario("raul", "raul@gmail.com", "raul", "raul")
      );
      unset($daousuario);
   }
}
?>