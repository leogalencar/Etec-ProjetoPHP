<?php include_once 'cabecalho.php'; ?>

<?php
include_once '../class/Imagem_Fornecedor.php';
$img = new Imagem();
$id_fornecedor = filter_input(INPUT_GET, 'id_fornecedor');
$img->setId_fornecedor($id_fornecedor);
?>

<h3 class="mt-3 text-primary">
    Cadastrar Imagem
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <div class="form-group row">            
            <label for="inputText" class="col-sm-2 col-form-label">                
                Imagem
            </label>
            <div class="col-sm-10">
                <input type="file" class="form-control-file" id="imagem" name="imagem[]" required multiple>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">            
                <input type="submit" 
                       class="btn btn-primary" 
                       name="btnsalvar" 
                       value="Cadastrar">               
            </div>
            <a href="?p=fornecedor/consultar" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {

    $imagem = $_FILES['imagem'];

    for ($i = 0; $i < count($imagem['name']); $i++) {
        $extensao = strtolower(pathinfo($imagem['name'][$i], PATHINFO_EXTENSION));
        
        if(strstr('png', $extensao) || strstr('jpg', $extensao)){
            $novoNome = sha1(uniqid(time())) . "." . $extensao;
            $img->setEndereco($novoNome);
            $img->setTemp_endereco($imagem['tmp_name'][$i]);
            $img->setId_fornecedor($id_fornecedor);
            $img->enviarArquivos();
            
            echo $img->salvar() == TRUE ? "Imagem salva com sucesso" : "Erro ao salvar imagem";
        }
    }
}









