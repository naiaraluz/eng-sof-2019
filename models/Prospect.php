<?php
namespace models;

class Prospect{

   public function incluirProspect($nome, $email, $celular, $facebook, $whatsapp){
      $conexaoDB = $this->conectarBanco();

      $sqlInsert = $conexaoDB->prepare("insert into prospect
                                        (nome, email, celular, facebook, whatsapp)
                                       values
                                       (?,?,?,?,?)");
      $sqlInsert->bind_param("sssss", $nome, $email,$celular,$facebook,$whatsapp);
      $sqlInsert->execute();

      if(!$sqlInsert->error){
         $retorno = TRUE;
      }else{
         $retorno = FALSE;
      }
      $conexaoDB->close();
      $sqlInsert->close();
      return $retorno;
   }
   public function atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect){
      $conexaoDB = $this->conectarBanco();

      $sqlUpdate = $conexaoDB->prepare("update prospect set
                                        nome = ?,
                                        email = ?,
                                        celular = ?,
                                        facebook = ?,
                                        whatsapp = ?
                                        where
                                        cod_prospect = ?");
      $sqlUpdate->bind_param("sssssi", $nome, $email,$celular,$facebook,$whatsapp, $codProspect);
      $sqlUpdate->execute();

      if(!$sqlUpdate->error){
         $retorno = TRUE;
      }else{
         $retorno = FALSE;
      }
      $conexaoDB->close();
      $sqlUpdate->close();
      return $retorno;
   }
   public function excluirProspect($codProspect){
      $conexaoDB = $this->conectarBanco();

      $sqlDelete = $conexaoDB->prepare("delete from prospect
                                        where
                                        cod_prospect = ?");
      $sqlDelete->bind_param("i", $codProspect);
      $sqlDelete->execute();

      if(!$sqlDelete->error){
         $retorno = TRUE;
      }else{
         $retorno = FALSE;
      }
      $conexaoDB->close();
      $sqlDelete->close();
      return $retorno;
   }
   public function buscarProspects($email=null){
      $conexaoDB = $this->conectarBanco();
      $prospects = array();

      if($email === null){
         $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect");
         $sqlBusca->execute();
      }else{
         $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                          facebook, whatsapp
                                          from prospect
                                          where
                                          email = ?");
         $sqlBusca->bind_param("s", $email);
         $sqlBusca->execute();
      }

      $resultado = $sqlBusca->get_result();
      if($resultado->num_rows !== 0){
         while($linha = $resultado->fetch_assoc()){
            $prospect = array(
               "codProspect" => $linha['cod_prospect'],
               "nome" => $linha['nome'],
               "email" => $linha['email'],
               "celular" => $linha['celular'],
               "facebook" => $linha['facebook'],
               "whatsapp" => $linha['whatsapp']
            );
            $prospects[] = $prospect;
         }
      }
      return $prospects;
      $conexaoDB->close();
      $sqlBusca->close();

   }
   private function conectarBanco(){
      $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
      return $conn;
   }
}

?>