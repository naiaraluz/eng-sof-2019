<?php
namespace Model;

class Prospect {
    public $id;
    public $nome;
    public $cpf;
    public $cep;
    public $rua;
    public $bairro;
    public $cidade;
    public $uf;
    public $email;
    public $zipzop;
    public $facebook;

    public function buscarProspect($email=null) {
        $conexaoDB = $this->conectarBanco();
        $prospects = array();

        if ($email === null) {
            $sql = $conexaoDB->prepare("select nome, cpf, cep, rua, bairro, cidade, uf, email, zipzop, facebook from prospect");

        } else {
            $sql = $conexaoDB->prepare("select nome, cpf, cep, rua, bairro, cidade, uf, email, zipzop, facebook from prospect
            where
            email = ?");
            $sql->bind_param("s", $email);
        }
        
        $sql->execute();

        $resultado = $sql->get_result();

        if($resultado->num_rows !== 0) {
            
            while($linha = $resultado->fetch_assoc()) {
                $prospect = array(
                    "id" => $linha['id'],
                    "nome" => $linha['nome'],
                    "cpf" => $linha['cpf'],
                    "cep" => $linha['cep'],
                    "rua" => $linha['rua'],
                    "bairro" => $linha['bairro'],
                    "cidade" => $linha['cidade'],
                    "uf" => $linha['uf'],
                    "email" => $linha['email'],
                    "zipzop" => $linha['zipzop'],
                    "facebook" => $linha['facebook']
                );
                $prospects[] = $prospect;
            }
        }
        $sql->close();
        $conexaoDB->close();
        return $prospects;
    }

    public function incluirProspect($nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook) {
        $conexaoDB = $this->conectarBanco();

        $sqlInsert = $conexaoDB->prepare("insert into prospect
                                        (nome, cpf, cep, rua, bairro, cidade, uf, email, zipzop, facebook)
                                        values
                                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sqlInsert->bind_param("ssssssssss", $nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook);

        $sqlInsert->execute();

        if (!$sqlInsert->error) {
            return TRUE;

        } else {
            return FALSE;
        }
        $sqlInsert->close();
        $conexaoDB->close();
    }

    public function alterarProspect($nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook, $id) {
        $conexaoDB = $this->conectarBanco();

        $sqlUpdate = $conexaoDB->prepare("update prospect set
                                        nome = ?, cpf = ?, cep = ?, rua = ?, bairro = ?, cidade = ?, uf = ?, email = ?, zipzop = ?, facebook = ?
                                        where
                                        id = ?"
                                        );
        $sqlUpdate->bind_param("ssssssssssi", $nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook, $id);

        $sqlUpdate->execute();

        if (!$sqlUpdate->error) {
            return TRUE;

        } else {
            return FALSE;
        }
        $sqlUpdate->close();
        $conexaoDB->close();
    }

    public function deletarProspect($id) {
        $conexaoDB = $this->conectarBanco();
        
        $sqlDelete = $conexaoDB->prepare("delete from prospect
                                        where
                                        id = ?");
       $sqlDelete->bind_param("i", $id);
                                        
       $sqlDelete->execute();

        if (!$sqlDelete->error) {
            return TRUE;

        } else {
            return FALSE;
        }
        $sqlDelete->close();
        $conexaoDB->close();
    }

    private function conectarBanco() {
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        return $conn;
    }
}
?>