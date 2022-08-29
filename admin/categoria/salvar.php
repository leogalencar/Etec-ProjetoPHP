<?php
include_once '../class/Categoria.php';
$cat = new Categoria();
$tipo = "";
$descricao = "";
if (filter_input(INPUT_GET, 'id') != NULL) {
    $id = filter_input(INPUT_GET, 'id');
    $tipo = "editar";

    $cat->setId($id);
    $dados = $cat->consultarPorID();

    foreach ($dados as $mostrar) {
        $descricao = $mostrar['descricao'];
    }
};

?>

<h3 class="mt-3 text-primary">
    Cadastrar Categoria
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <!-- m-3 determinei todas as bordas, não mudei o form-->
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Descrição
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtDescricao" name="txtdescricao" placeholder="Descrição de Categoria" maxlength="50" value="<?= $tipo == "editar" ? $descricao : "" ?>">
            </div>
        </div>
        <div class="form-group row">            
            <label for="inputText" class="col-sm-2 col-form-label">                
                URL Vídeo - YouTube
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtvideo" name="txtvideo" placeholder="URL do vídeo" maxlength="100" value="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnsalvar" value="Cadastrar">
            </div>
            <!-- faltou um link aqui-->
            <a href="?p=categoria/consultar" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {

    $url_video = str_replace("https://youtu.be/","",filter_input(INPUT_POST, 'txtvideo', FILTER_SANITIZE_STRING));
    $url_video = str_replace("https://www.youtube.com/watch?v=","",$url_video); 

    $descricao = filter_input(INPUT_POST, 'txtdescricao', FILTER_SANITIZE_STRING);

    $cat->setDescricao($descricao);
    $cat->setVideo($url_video);
    //aqui chamo o método salvar
?>

    <div class="alert alert-<?= $tipo == "editar" ? "success" : "primary" ?> mt-3" role="alert">
        <?php
        if ($tipo == "editar") {
            echo $cat->salvar() ? "editado" : "erro";
        } else {
            $cat->setId(NULL);
            echo $cat->salvar();
        }
        ?>
    </div>

<?php
}
