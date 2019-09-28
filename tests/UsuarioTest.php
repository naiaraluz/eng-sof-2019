<?php
namespace tests;

require_once('../vendor/autoload.php');
require_once('../Model/Usuario.php');

use Model\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase {

    /** @test */
    public function testLogar() {
        $usuario = new Usuario();
        $this->assertEquals(
            TRUE,
            $usuario->logar('nainai', '123')
        );
        unset($usuario);
    }

    /** @test */
    public function testIncluirUsuario() {
        $usuario = new Usuario();
        $this->assertEquals(
            TRUE,
            $usuario->incluirUsuario('naiara', 'nainai@gmail.com', 'nainai', '123')
        );
        unset($usuario);
    }
}
?>