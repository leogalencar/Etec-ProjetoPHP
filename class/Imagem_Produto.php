<?php

 

include_once 'Conectar.php';
include_once 'Controles.php';

 

class Imagem {
    private $id;
    private $endereco;
    private $data_publicacao;
    private $id_produto;
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

 

    function getId_produto() {
        return $this->id_produto;
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

 

    function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

 

    function setTemp_endereco($temp_endereco) {
        $this->temp_endereco = $temp_endereco;
    }

 


}