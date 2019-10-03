<?php
namespace test;
require_once('../vendor/autoload.php');
require_once('../models/Usuario.php');
use PHPUnit\Framework\TestCase;
use models\Usuario;

class UsuarioTest extends TestCase{

   /** @test */
   public function testLogar(){
      $usuario = new Usuario();
      $this->assertEquals(
         TRUE,
         $usuario->logar('paulo', '123')
      );

      unset($usuario);
   }
   /** @test */
   public function testIncluirUsuario(){
      $usuario = new Usuario();
      $this->assertEquals(
         TRUE,
         $usuario->incluirUsuario("raul", "raul@gmail.com", "raul", "raul")
      );
      unset($usuario);
   }
}
?>