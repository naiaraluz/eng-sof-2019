<?php
namespace tests;

require_once('../vendor/autoload.php');
require_once('../Model/Prospect.php');

use Model\Prospect;
use PHPUnit\Framework\TestCase;

class ProspectTest extends TestCase {

    /** @test */
    public function testBuscarProspect() {
        $prospect = new Prospect();
        $prospects[] = $prospect->buscarProspect('email2');

        $prospect = $prospects[0];

        $this->assertEquals(
            'cpf2',
            $prospect[0]['cpf']
        );
        unset($prospect);
        unset($prospects);
    }

    /** @test */
    public function testIncluirProspect() {
        $prospect = new Prospect();
        $this->assertEquals(
            TRUE,
            $prospect->incluirProspect('nome', 'cpf', 'cep', 'rua', 'bairro', 'cidade', 'uf', 'email', 'zipzop', 'facebook')
        );
        unset($prospect);
    }

    /** @test */
    public function testAlterarProspect() {
        $prospect = new Prospect();
        $this->assertEquals(
            TRUE,
            $prospect->alterarProspect('nome2', 'cpf2', 'cep2', 'rua2', 'bairro2', 'cidade2', 'uf2', 'email2', 'zipzop2', 'facebook2', 2)
        );
        unset($prospect);
    }

    /** @test */
    public function testDeletarProspect() {
        $prospect = new Prospect();
        $this->assertEquals(
            TRUE,
            $prospect->deletarProspect(1)
        );
        unset($prospect);
    }
}
?>