<?php

include_once 'Conectar.php';

class Categoria
{

    private $id;
    private $descricao;
    private $video;
    private $con;

    function getId()
    {
        return $this->id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function getVideo() {
        return $this->video;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setVideo($video) {
        $this->video = $video;
    }

    function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("CALL salvar_categoria(?,?,?);");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            $sql->bindValue(2, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(3, $this->video, PDO::PARAM_STR);

            if ($sql->execute() == 1) {
                return "cadastrado";
            } else {
                return "erro";
            }
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    } //salvar

    function editar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("UPDATE categoria SET descricao = ? WHERE id = ?");
            $sql->bindValue(1, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(2, $this->id, PDO::PARAM_STR);


            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro ao editar " . $exc->getMessage();
        }
    } //salvar

    function consultar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * FROM categoria");

            if ($sql->execute() == 1) {
                return $sql->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar " . $exc->getMessage();
        }
    } //consultar

    function consultarPorID()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from categoria WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);

            return $sql->execute() == 1 ? $sql->fetchAll() : false;
        } catch (PDOException $exc) {
            echo "Erro ao consultar" . $exc->getMessage();
        }
    } //salvar

    function excluir()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("DELETE from categoria WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);

            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";
        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    } //salvar

    function paginar($inicio, $total_reg) {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM categoria LIMIT $inicio,$total_reg ";
            $executar = $this->con->prepare($sql);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}

//fim class
