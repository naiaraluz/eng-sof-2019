<?php
namespace test;
require_once('../../uteis/vendor/autoload.php');
require_once('../models/Usuário.php');
require_once('../controllers/ControllerUsuario.php');
use PHPUnit\Framework\TestCAse;
use models\Usuario;
use controllers\ControllerUsuario;

class ControllerUsuarioTest extends TestCase{
    /** @test */
    public function testLogar(){
        $ctrlUsuario = new ControllerUsuario();
        $usuario = new Usuario();

        $usuario->addUsuario("paulo","paulo", "paulo@eu.com", "", TRUE);

        $this->asserEquals(
            $usuario,
            $ctrlUsuario->fazerLogin('paulo', '123')
        );
    }

    public function testIncluirUsuario(){
        $ctrlUsuario = new ControllerUsuario();
        $usuario = new Usuario();

        try{
            $this->asserEquals(
                TRUE;
                $ctrlUsuario->salvarusuario('Marcos Dias', 'dias@noites.com', 'dias', '145')
            );
        }catch(\Exception $e){
            $this->fail($e->getMessage());
        }
    }
}