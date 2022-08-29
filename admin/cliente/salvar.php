<?php
include_once '../class/Cliente.php';
$cli = new Cliente();
$tipo = $nome = $email = $telefone = $video = "";

if (filter_input(INPUT_GET, 'id') != NULL) {
    $id = filter_input(INPUT_GET, 'id');
    $tipo = "editar";

    $cli->setId($id);
    $dados = $cli->consultarPorID();

    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $email = $mostrar['email'];
        $telefone = $mostrar['telefone'];
        $video = $mostrar['video'];
    }
};
?>

<h3 class="mt-3 text-primary">
    Cadastrar Cliente
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <!-- m-3 determinei todas as bordas, não mudei o form-->
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Nome
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtNome" name="txtnome" placeholder="Nome do cliente" maxlength="50" value="<?= $tipo == "editar" ? $nome : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Email
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtEmail" name="txtemail" placeholder="Email do cliente" maxlength="50" value="<?= $tipo == "editar" ? $email : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Telefone
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtTelefone" name="txttelefone" placeholder="Telefone do cliente" maxlength="20" value="<?= $tipo == "editar" ? $telefone : "" ?>">
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
            <a href="?p=cliente/consultar" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'txttelefone', FILTER_SANITIZE_STRING);

    $url_video = str_replace("https://youtu.be/","",filter_input(INPUT_POST, 'txtvideo', FILTER_SANITIZE_STRING));
    $url_video = str_replace("https://www.youtube.com/watch?v=","",$url_video); 

    $cli->setNome($nome);
    $cli->setEmail($email);
    $cli->setTelefone($telefone);
    $cli->setVideo($url_video);
    //aqui chamo o método salvar
?>

    <div class="alert alert-<?= $tipo == "editar" ? "success" : "primary" ?> mt-3" role="alert">
        <?php
        if ($tipo == "editar") {
            echo $cli->salvar() ? "editado" : "erro";
        } else {
            $cli->setId(NULL);
            echo $cli->salvar();
        }
        ?>
    </div>

<?php
}
