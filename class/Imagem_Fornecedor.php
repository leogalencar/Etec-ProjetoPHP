<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Imagem {
    private $id;
    private $endereco;
    private $data_publicacao;
    private $id_fornecedor;
    private $temp_endereco;
    private $con;
    private $ct;
    private $caminho = "../img/";
    
    function getId() {
        return $this->id;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getData_publicacao() {
        return $this->data_publicacao;
    }

    function getId_fornecedor() {
        return $this->id_fornecedor;
    }

    function getTemp_endereco() {
        return $this->temp_endereco;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setData_publicacao($data_publicacao) {
        $this->data_publicacao = $data_publicacao;
    }

    function setId_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
    }

    function setTemp_endereco($temp_endereco) {
        $this->temp_endereco = $temp_endereco;
    }

    function salvar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("INSERT INTO imagem_fornecedor VALUES (null, ?, ?, ?)");
            $sql->bindValue(1, $this->endereco, PDO::PARAM_STR);
            $sql->bindValue(2, date('Y-m-d'), PDO::PARAM_STR);
            $sql->bindValue(3, $this->id_fornecedor, PDO::PARAM_INT);

            return ($sql->execute() == 1 ? TRUE : FALSE);
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }
    
    function enviarArquivos(){
        $this->ct = new Controles();
        
        return $this->ct->enviarArquivo($this->temp_endereco, $this->caminho . $this->endereco, "Imagem de Fornecedor");
    }

    function consultar() {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT i.*, f.* "
                    . "FROM imagem_fornecedor i, fornecedor f "
                    . "WHERE i.id_fornecedor = f.id "
                    . "AND i.id_fornecedor = ?");
            $sql->bindValue(1, $this->id_fornecedor, PDO::PARAM_INT);

            return ($sql->execute() == 1 ? $sql->fetchAll() : FALSE);
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    }
}