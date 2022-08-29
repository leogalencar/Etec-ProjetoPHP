<?php

include_once 'Conectar.php';

class Cliente {

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $con;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("INSERT INTO cliente VALUES(null, :nome, :email, :telefone)");
            $sql->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $sql->bindValue(':email', $this->email, PDO::PARAM_STR);
            $sql->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
            
            if($sql->execute() == 1){
                return "cadastrado";
            }else{
                return "erro";
            }
            
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }//salvar
    
    function consultar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * FROM cliente");
                        
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
            $sql = $this->con->prepare("SELECT * from cliente WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? $sql->fetchAll() : false;

        } catch (PDOException $exc) {
            echo "Erro ao consultar" . $exc->getMessage();
        }
    } //salvar

}

//fim class
