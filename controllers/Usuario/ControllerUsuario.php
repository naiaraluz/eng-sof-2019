<?php
namespace CONTROLLERS;
require_once('../DAO/DAOUsuario.php');
use DAO\DAOUsuario;

/**
 * Esta classe é responsável por fazer o tratamento dos dados para apresentação e/ou
 * envio para a DAO
 * Seu escopo limita-se às funções da entidade Usuário
 * 
 * @author Naiara de Oliveira Luz e Lucas Gois
 */
class ControllerUsuario{
    /**
     * Recebe os dados de login, faz o devido tratamento e envia para a DAO executar
     * no banco de dados
     * @param string $login Login do usuário
     * @param string $senha Senha do usuário
     * @return Usuario
     */
    public function fazerLogin($login, $senha){
        $daoUsuario = new DAOUsuario();

        $usuario = $daoUsuario->logar($login, $senha);

        unset($daoUsuario);
        return $usuario;
    }
    /**
     * Recebe e trata os daddos do usuário e envia para a DAO
     * gravar no banco de dados
     * 
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $login Login do usuário
     * @param string $senha Senha do usuário
     * @return TRUE|Exception Retorna TRUE caso a inclusão tenha sido bem sucedida
     * ou uma Excpetion caso não tenha
     */
    public function salvarUsuario($nome, $email, $login, $senha){
        $daoUsuario = new DAOUsuario();
        /**
         * Captura a exceção retornada pela DAO no caso de falha ao incluir um usuário
         * e dispara outra exceção pra ser tratada por quem chama esta função
         */
        try {
            $retorno = $daoUsuario->incluirUsuario($nome, $email, $login, $senha);
            unset($daoUsuario);
            return $retorno;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}

?>
