<?php
namespace models;

class Usuario{
   public $login;
   public $nome;
   public $email;
   public $celular;
   public $logado;

   public function logar($login, $senha){
      $conexaoDB = $this->conectarBanco();
      $sql = $conexaoDB->prepare("select login, nome, email, celular from usuario
                                  where
                                  login = ?
                                  and
                                  senha = ?");
      $sql->bind_param("ss", $login, $senha);
      $sql->execute();

      $resultado = $sql->get_result();
      if($resultado->num_rows === 0){
         $this->login = null;
         $this->nome = null;
         $this->email = null;
         $this->celular = null;
         $this->logado = FALSE;
      }else{
         While($linha = $resultado->fetch_assoc()){
            $this->login = $linha['login'];
            $this->nome = $linha['nome'];
            $this->email = $linha['email'];
            $this->celular = $linha['celular'];
            $this->logado = TRUE;
         }
      }
      $sql->close();
      $conexaoDB->close();
      return $this->logado;
   }
   public function incluirUsuario($nome, $email, $login, $senha){
      $conexaoDB = $this->conectarBanco();

      $sqlInsert = $conexaoDB->prepare("insert into usuario
                                       (nome, email, login, senha)
                                       values
                                       (?, ?, ?, ?)");
      $sqlInsert->bind_param("ssss", $nome, $email, $login, $senha);
      $sqlInsert->execute();
      if(!$sqlInsert->error){
         $retorno =  TRUE;
      }else{
         $retorno =  FALSE;
      }
      $conexaoDB->close();
      $sqlInsert->close();
      return $retorno;
   }

   private function conectarBanco(){
      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      return $conn;
   }
}
?>