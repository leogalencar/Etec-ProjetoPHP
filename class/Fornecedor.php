<?php

include_once 'Conectar.php';

class Fornecedor {

    private $id;
    private $nome;
    private $cep;
    private $email;
    private $con;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCep() {
        return $this->cep;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("CALL salvar_fornecedor(:id, :nome, :cep, :email)");
            $sql->bindValue(':id', $this->id, PDO::PARAM_INT);
            $sql->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $sql->bindValue(':cep', $this->email, PDO::PARAM_STR);
            $sql->bindValue(':email', $this->cep, PDO::PARAM_STR);
            
            if($sql->execute() == 1){
                return "cadastrado";
            }else{
                return "erro";
            }
            
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }
    
    function editar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("UPDATE fornecedor SET nome = ?, cep = ?, email = ? WHERE id = ?");
            $sql->bindValue(1, $this->nome, PDO::PARAM_STR);
            $sql->bindValue(2, $this->cep, PDO::PARAM_STR);
            $sql->bindValue(3, $this->email, PDO::PARAM_STR);
            $sql->bindValue(4, $this->id, PDO::PARAM_STR);

            
            return $sql->execute() == 1 ? TRUE : FALSE;
            
        } catch (PDOException $exc) {
            echo "Erro ao editar " . $exc->getMessage();
        }
    }
    
    function consultar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * FROM fornecedor");
                        
            if($sql->execute() == 1){
                return $sql->fetchAll();
            }else{
                return false;
            }            
        } catch (PDOException $exc) {
            echo "Erro ao consultar " . $exc->getMessage();
        }
    }

    function consultarPorID(){
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from fornecedor WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? $sql->fetchAll() : false;

        } catch (PDOException $exc) {
            echo "Erro ao consultar" . $exc->getMessage();
        }
    }

    function excluir(){
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("DELETE from fornecedor WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";

        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    }

}