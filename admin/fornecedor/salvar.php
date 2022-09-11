<?php include_once 'cabecalho.php'; ?>

<?php
include_once '../class/Fornecedor.php';
$fornecedor = new Fornecedor();
$tipo = $nome = $cep = $email = "";

if (filter_input(INPUT_GET, 'id') != NULL) {
    $id = filter_input(INPUT_GET, 'id');
    $tipo = "editar";

    $fornecedor->setId($id);
    $dados = $fornecedor->consultarPorID();

    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $cep = $mostrar['cep'];
        $email = $mostrar['email'];
    }
};
?>

<h3 class="mt-3 text-primary">
    Cadastrar Fornecedor
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <!-- m-3 determinei todas as bordas, não mudei o form-->
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Nome
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtNome" name="txtnome" placeholder="Nome do fornecedor" maxlength="50" value="<?= $tipo == "editar" ? $nome : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Cep
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtCep" name="txtcep" placeholder="00000-000" maxlength="9" value="<?= $tipo == "editar" ? $cep : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Email
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtEmail" name="txtemail" placeholder="empresa@email.com" maxlength="50" value="<?= $tipo == "editar" ? $email : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnsalvar" value="Cadastrar">
            </div>
            <!-- faltou um link aqui-->
            <a href="?p=fornecedor/consultar" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {

    $nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
    $cep = filter_input(INPUT_POST, 'txtcep', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_STRING);

    $fornecedor->setNome($nome);
    $fornecedor->setEmail($cep);
    $fornecedor->setCep($email);
    //aqui chamo o método salvar
?>

    <div class="alert alert-<?= $tipo == "editar" ? "success" : "primary" ?> mt-3" role="alert">
        <?php
        if ($tipo == "editar") {
            echo $fornecedor->salvar() ? "editado" : "erro";
        } else {
            $fornecedor->setId(NULL);
            echo $fornecedor->salvar();
        }
        ?>
    </div>

<?php
}
