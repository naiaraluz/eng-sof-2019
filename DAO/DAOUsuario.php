<?php
namespace models;
mysqli_report(MYSQLI_REPORT_STRICT);
require_once('../models/Usuario.php');
use MODELS\Usuario;

/**
 * Esta classe é responsável por fazer a comunicação com o banco de dados
 * provendo as funções de logar e incluir um novo usuário
 * @author Naiara de Oliveira Luz e Lucas Gois
 * @package DAO
 */

class DAOUsuario{

   /**
    * Faz o login do usuário no sistema e retorna um objeto usuário
    *@param string $login Login do usuário
    *@param string $senha Senha do usuário
    *@return Usuario Se logado com sucesso os atributos serão retornados 
    *com os dados do usuário, senão retornatão com o valor nulo,
    *exceto o atributo $logado, que retorna FALSE
    */
   public function logar($login, $senha){
      try{
         $conexaoDB = $this->conectarBanco();
      }catch (\Exception $e){
         die($e->getMessage());
      }
      $usuario = new Usuario();
      $sql = $conexaoDB->prepare("select login, nome, email, celular from usuario
                                  where
                                  login = ?
                                  and
                                  senha = ?");
      $sql->bind_param("ss", $login, $senha);
      $sql->execute();
      $resultado = $sql->get_result();
      if($resultado->num_rows === 0){
         $usuario->addUsuario(null, null, null, null, FALSE);
      }else{
         While($linha = $resultado->fetch_assoc()){
            $usuario->addUsuario($linha['login'], $linha['nome'], $linha['email'], $linha['celular'], TRUE);
         }
      }
      $sql->close();
      $conexaoDB->close();
      return $usuario;
   }
   /**
    * Inclui um novo usuário
    *@param String $nome Nome do usuário
    *@param String $email Email do usuário
    *@param String $login Login do usuário
    *@param String $senha Senha do usuário
    *@return TRUE|Exception TRUE para inclusão bem sucedida ou Exception para inclusão mal sucedida
    */
   public function incluirUsuario($nome, $email, $login, $senha){
      try{
      $conexaoDB = $this->conectarBanco();

      }catch(\Exception $e){
         die($e->getMessage());
      }

      $sqlInsert = $conexaoDB->prepare( "insert into usuario
                                       (nome, email, login, senha)
                                       values
                                       (?, ?, ?, ?)");
      $sqlInsert->bind_param("ssss", $nome, $email, $login, $senha);
      $sqlInsert->execute();
      if(!$sqlInsert->error){
         $retorno =  TRUE;
      }else{
         throw new \Excption("Não foi possível incluir novo usuário");
         die;
      }
      $conexaoDB->close();
      $sqlInsert->close();
      return $retorno;
   }
   /**
    * Realiza a conexão com o banco de dados usando msqli
    *@return \mysqli|Excption
    */
   private function conectarBanco(){
      define ('DS', DIRECTORY_SEPARATOR);
      define ('BASE_DIR', dirname(__FILE__).DS);
      require_once(BASE.DIR.'conf.php');
      require_once('config.php');
      try{
      $conn = new \mysqli($dbhost, $user, $password, $banco);
      return $conn;
      }catch(mysqli_sql_exception $e){
         throw new \Excption ($e);
         die;
      }
   }
}
?>