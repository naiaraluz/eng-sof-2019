<?php
namespace models;

class Usuario{
    public $login;
    public $nome;
    public $logado;
    public $email;

    public function logar($login, $senha){
        $conexaoDB = $this->conectarBanco();
        $sql = $conexaoDB->prepare("select login, nome, logado, celular from usuario
                                    where
                                    login = ?
                                    and
                                    senha = ?");
        $sql->bind_param("ss", $login, $senha);
        $sql->execute();

        $resultado =$sql->get_result();
        if($resultado->num_rows() ==== "0"){
          $this->login = null;
          $this->nome = null;  
          $this->email = null; 
          $this->logado = null;
        }
    }
    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        return $conn;
    }
}
?>