<?php
namespace models;
mysqli_report(MYSQLI_REPORT_STRICT);
require_once('../models/Prospect.php');

use MODELS\Prospect;

/**
 * Esta classe é responsável por fazer a comunicação com o banco de dados
 * provendo as funções de incluir, atualizar, buscar e excluir prospects;
 * @author Naiara de Oliveira Luz e Lucas Gois
 * @package DAO
 */

 class DAOProspect {
     /**
    * Inclui um novo prospecto
    *@param String $nome Nome do prospecto
    *@param String $email Email do prospecto
    *@param String $facebook Facebook do prospecto
    *@param String $whatsapp WhatsApp do prospecto
    *@return TRUE|Exception TRUE para inclusão bem sucedida ou Exception para inclusão mal sucedida
    */
    public function incluirProspect($nome, $email, $celular, $facebook, $whatsapp){
        
        try{
            $conexaoDB = $this->conectarBanco();
        
        }catch(\Exception $e){
            die($e->getMessage());
        }    
  
        $sqlInsert = $conexaoDB->prepare("insert into prospect
                                          (nome, email, celular, facebook, whatsapp)
                                         values
                                         (?,?,?,?,?)");
        $sqlInsert->bind_param("sssss", $nome, $email,$celular,$facebook,$whatsapp);
        $sqlInsert->execute();
        if(!$sqlInsert->error){
            $retorno =  TRUE;
         }else{
            throw new \Excption("Não foi possível incluir no prospecto");
            die;
         }
        $conexaoDB->close();
        $sqlInsert->close();
        return $retorno;
     }

     /**
    * Atualiza um prospecto
    *@param String $nome Nome do prospecto
    *@param String $email Email do prospecto
    *@param String $facebook Facebook do prospecto
    *@param String $whatsapp WhatsApp do prospecto
    *@return TRUE|Exception TRUE para atualização bem sucedida ou Exception para inclusão mal sucedida
    */
     public function atualizarProspect($nome, $email, $celular, $facebook, $whatsapp, $codProspect){
        try{
            $conexaoDB = $this->conectarBanco();
        
        }catch(\Exception $e){
            die($e->getMessage());
        }  
  
        $sqlUpdate = $conexaoDB->prepare("update prospect set
                                          nome = ?,
                                          email = ?,
                                          celular = ?,
                                          facebook = ?,
                                          whatsapp = ?
                                          where
                                          cod_prospect = ?");
        $sqlUpdate->bind_param("sssssi", $nome, $email, $celular, $facebook, $whatsapp, $codProspect);
        $sqlUpdate->execute();

        if(!$sqlUpdate->error){
            $retorno =  TRUE;
         }else{
            throw new \Excption("Não foi possível atualizar o prospecto");
            die;
         }
  
        $conexaoDB->close();
        $sqlUpdate->close();
        return $retorno;
     }

     /**
    *Busca um prospecto e retorna uma array de objetvos do tipo prospect
    *@param String $email Email do prospecto
    *@return Array[Prospect]|Exception se informado o email retorna o prospect relacionado, 
    *senão, retorna tudo. E em caso de erro retorna o Exception
    */
    public function buscarProspects($email=null){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch (\Exception $e){
            die($e->getMessage());
        }

        $prospects = array();
  
        if($email === null){
           $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                            facebook, whatsapp
                                            from prospect");
        }else{
           $sqlBusca = $conexaoDB->prepare("select cod_prospect, nome, email, celular,
                                            facebook, whatsapp
                                            from prospect
                                            where
                                            email = ?");
           $sqlBusca->bind_param("s", $email);
        }

        $sqlBusca->execute();

        if($sqlBusca->error){
            throw new \Exception("Não foi possível efetuar a busca");
            die;
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

     /**
    *Exclui um prospecto
    *@param int $codProspect Códgio do prospecto
    *@return TRUE|Exception TRUE para exclusão bem sucedida ou Exception para exclusão mal sucedida
    */
     public function excluirProspect($codProspect){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch (\Exception $e){
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("delete from prospect
                                          where
                                          cod_prospect = ?");
        $sqlDelete->bind_param("i", $codProspect);
        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno =  TRUE;
         }else{
            throw new \Excption("Não foi possível incluir no prospecto");
            die;
        }

        $conexaoDB->close();
        $sqlDelete->close();
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