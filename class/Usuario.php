<?php

include_once 'Conectar.php';

class Usuario {

    private $matricula;
    private $senha;
    private $tipo;
    private $con;

    public function getMatricula() {
        return $this->matricula;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setMatricula($matricula): void {
        $this->matricula = $matricula;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    // public function consultar() {
    //     try {
    //         $this->con = new Conectar();
    //         if ($this->matricula != "" || $this->matricula != NULL) {
    //             $sql = "SELECT * FROM usuario where matricula = ? AND senha = ?";
    //             $ligacao = $this->con->prepare($sql);
    //             $ligacao->bindValue(1, $this->matricula, PDO::PARAM_INT);
    //             $ligacao->bindValue(2, sha1($this->senha), PDO::PARAM_STR);
    //         }

    //         if ($ligacao->execute() == 1) {
    //             return $ligacao->fetchAll();
    //         } else {
    //             return false;
    //         }
    //     } catch (PDOException $exc) {
    //         echo $exc->getMessage();
    //     }
    // }

    function consultar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * FROM usuario");
                        
            if($sql->execute() == 1){
                return $sql->fetchAll();
            }else{
                return false;
            }            
        } catch (PDOException $exc) {
            echo "Erro ao consultar " . $exc->getMessage();
        }
    }//consultar

    function consultarPorID(){
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from usuario WHERE matricula = ?");
            $sql->bindValue(1, $this->matricula, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? $sql->fetchAll() : false;

        } catch (PDOException $exc) {
            echo "Erro ao consultar" . $exc->getMessage();
        }
    } //salvar
    
    public function consultarAluno() {
        try {
            $this->con = new Conectar();
            if ($this->matricula != "" || $this->matricula != NULL) {
                $sql = "SELECT * FROM aluno where ra_aluno = ? AND senha = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $this->matricula, PDO::PARAM_INT);
                $ligacao->bindValue(2, sha1($this->senha), PDO::PARAM_STR);
            }

            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function trocarSenha($tipoUsuario) {
        try {
            $this->con = new Conectar();

            if ($tipoUsuario > 0) {
                $sql = "UPDATE docente SET senha = ? WHERE matricula_docente = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, sha1($this->senha), PDO::PARAM_STR);
                $ligacao->bindValue(2, $this->matricula, PDO::PARAM_INT);
                return $ligacao->execute() == 1 ? $ligacao->fetchAll() : false;
            } else {
                $sql = "UPDATE aluno SET senha = ? WHERE ra_aluno = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, sha1($this->senha), PDO::PARAM_STR);
                $ligacao->bindValue(2, $this->matricula, PDO::PARAM_INT);
                return $ligacao->execute() == 1 ? $ligacao->fetchAll() : false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("CALL salvar_usuario(:matricula, :senha)");
            $sql->bindValue(':matricula', $this->matricula, PDO::PARAM_INT);
            $sql->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            
            if($sql->execute() == 1){
                return "cadastrado";
            }else{
                return "erro";
            }
            
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }//salvar

    function excluir(){
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("DELETE from usuario WHERE matricula = ?");
            $sql->bindValue(1, $this->matricula, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";

        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    } //salvar

}
