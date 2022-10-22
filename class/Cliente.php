<?php

include_once 'Conectar.php';

class Cliente {

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $video;
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

    function getVideo() {
        return $this->video;
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

    function setVideo($video) {
        $this->video = $video;
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("CALL salvar_cliente(:id, :nome, :email, :telefone, :video)");
            $sql->bindValue(':id', $this->id, PDO::PARAM_INT);
            $sql->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $sql->bindValue(':email', $this->email, PDO::PARAM_STR);
            $sql->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
            $sql->bindValue(':video', $this->video, PDO::PARAM_STR);
            
            if($sql->execute() == 1){
                return "cadastrado";
            }else{
                return "erro";
            }
            
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }//salvar
    
    function editar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("UPDATE cliente SET nome = ?, email = ?, telefone = ?, video = ? WHERE id = ?");
            $sql->bindValue(1, $this->nome, PDO::PARAM_STR);
            $sql->bindValue(2, $this->email, PDO::PARAM_STR);
            $sql->bindValue(3, $this->telefone, PDO::PARAM_STR);
            $sql->bindValue(4, $this->video, PDO::PARAM_STR);
            $sql->bindValue(5, $this->id, PDO::PARAM_STR);

            
            return $sql->execute() == 1 ? TRUE : FALSE;
            
        } catch (PDOException $exc) {
            echo "Erro ao editar " . $exc->getMessage();
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

    function excluir(){
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("DELETE from cliente WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            
            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";

        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    } //salvar

    function paginar($inicio, $total_reg) {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM cliente LIMIT $inicio,$total_reg ";
            $executar = $this->con->prepare($sql);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

//fim class
