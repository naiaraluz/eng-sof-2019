<?php
namespace CONTROLLERS;
require_once('../../DAO/DAOUsuario.php');
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
    public fazerlogin(){
        $daoUsuario = new DAOUsuario();

        $usuario = $daoUsuario->logar($login, $senha);

        unset($daoUsuario);
        return $usuario;
    }
    public function salvarusuario($nome, $email, $login, $senha){
        
    }
}

?>
