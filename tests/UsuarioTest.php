<?php
namespace test;

require_once('..vendor/autoload.php');
require_once('../Model/Usuario.php');

use models\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase {
    /** @test */
    public function testLogar() {
        $usuario = new Usuario();
        $this->assertEquals(
            true,
            $usuario->logar('paulo', '123')
        );
        unset($usuario);
    }

    /** @test */
    public function testIncluirUsuario() {
        $usuario = new Usuario();
        $this->assertEquals(
            true,
            $usuario->incluirUsuario('nainai', 'nainai@gmail.com', 'nainai', '123')
        );
        unset($usuario);
    }
}
?>