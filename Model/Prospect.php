<?php
namespace Model;

class Prospect {
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

    public function buscarProspect($cpf) {
        $conexaoDB = $this->conectarBanco();
        $prospect = new Prospect();

        $sql = $conexaoDB->prepare("select nome, cpf, cep, rua, bairro, cidade, uf, email, zipzop, facebook from prospect
                                    where
                                    cpf = ?");
        $sql->bind_param("s", $cpf);
        $sql->execute();

        $resultado = $sql->get_result();

        if($resultado->num_rows === 0) {
            $this->nome = null;
            $this->cpf = null;
            $this->cep = null;
            $this->rua = null;
            $this->bairro = null;
            $this->cidade = null;
            $this->uf = null;
            $this->email = null;
            $this->zipzop = null;
            $this->facebook = null;

        }else{

            while($linha = $resultado->fetch_assoc()) {
                $prospect->nome = $linha['nome'];
                $prospect->cpf = $linha['cpf'];
                $prospect->cep = $linha['cep'];
                $prospect->rua = $linha['rua'];
                $prospect->bairro = $linha['bairro'];
                $prospect->cidade = $linha['cidade'];
                $prospect->uf = $linha['uf'];
                $prospect->email = $linha['email'];
                $prospect->zipzop = $linha['zipzop'];
                $prospect->facebook = $linha['facebook'];
            }
        }
        $sql->close();
        $conexaoDB->close();
        return $prospect;
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
    }

    public function alterarProspect($nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook, $id) {
        $conexaoDB = $this->conectarBanco();

        $sqlInsert = $conexaoDB->prepare("update prospect set
                                        nome = ?, cpf = ?, cep = ?, rua = ?, bairro = ?, cidade = ?, uf = ?, email = ?, zipzop = ?, facebook = ?
                                        where
                                        id = ?"
                                        );
        $sqlInsert->bind_param("ssssssssssi", $nome, $cpf, $cep, $rua, $bairro, $cidade, $uf, $email, $zipzop, $facebook, $id);

        $sqlInsert->execute();

        if (!$sqlInsert->error) {
            return TRUE;

        } else {
            return FALSE;
        }
    }

    public function deletarProspect($id) {
        $conexaoDB = $this->conectarBanco();
        
        $sqlInsert = $conexaoDB->prepare("delete from prospect
                                        where
                                        id = ?");
        $sqlInsert->bind_param("i", $id);
                                        
        $sqlInsert->execute();

        if (!$sqlInsert->error) {
            return TRUE;

        } else {
            return FALSE;
        }
    }

    private function conectarBanco() {
        $conn = new \mysqli('localhost', 'root', '', 'bd_prospects');
        return $conn;
    }
}
?>