<?php
namespace models;

class Usuario{
    public $login;
    public $nome;
    public $logado;
    public $email;

    public function logar($login, $senha){
        $conexaoDB = $this->conectarBanco();
    }
    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        return $conn;
    }
}
?>