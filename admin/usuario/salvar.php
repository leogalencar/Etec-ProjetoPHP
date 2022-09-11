<?php include_once 'cabecalho.php'; ?>

<?php
include_once '../class/Usuario.php';
$user = new Usuario();
$tipo = "";

if (filter_input(INPUT_GET, 'id') != NULL) {
    $id = filter_input(INPUT_GET, 'id');
    $tipo = "editar";

    $user->setMatricula($id);
    $dados = $user->consultarPorID();

    foreach ($dados as $mostrar) {
        $matricula = $mostrar['matricula'];
        $senha = $mostrar['senha'];
    }
};
?>

<h3 class="mt-3 text-primary">
    Cadastrar Usuario
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <!-- m-3 determinei todas as bordas, não mudei o form-->
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Matricula
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtMatricula" name="txtmatricula" placeholder="Matricula do usuario" maxlength="50" value="<?= $tipo == "editar" ? $matricula : "" ?>" <?= $tipo == "editar" ? "disabled" : "" ?>>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Senha
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="txtSenha" name="txtsenha" placeholder="Senha do usuario" maxlength="50" value="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnsalvar" value="Cadastrar">
            </div>
            <!-- faltou um link aqui-->
            <a href="?p=usuario/consultar" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    if ($tipo !== 'editar'){
        $matricula = filter_input(INPUT_POST, 'txtmatricula', FILTER_SANITIZE_STRING);
        $user->setMatricula($matricula);
    }
    
    $senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);
    $user->setSenha(sha1($senha));
    //aqui chamo o método salvar
?>

    <div class="alert alert-<?= $tipo == "editar" ? "success" : "primary" ?> mt-3" role="alert">
        <?php
        if ($tipo == "editar") {
            echo $user->salvar() ? "Editado" : "Erro ao editar";
        } else {
            echo $user->salvar() ? "Cadastrado" : "Erro ao cadastrar";
        }
        ?>
    </div>

<?php
}
