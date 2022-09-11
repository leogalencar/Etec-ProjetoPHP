<?php include_once 'cabecalho.php'; ?>

<?php
include_once '../class/Imagem.php';
$img = new Imagem();
$id_categoria = filter_input(INPUT_GET, 'id_categoria');
$img->setId_categoria($id_categoria);
?>

<h3 class="mt-3 text-primary">
    Cadastrar Imagem
</h3>

<div class="card shadow">
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <!-- m-3 determinei todas as bordas, não mudei o form-->
        <div class="form-group row">            
            <label for="inputText" class="col-sm-2 col-form-label">                
                Imagem
            </label>
            <!--intervalo, se vc está assistindo...adiante o vídeo-->
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
            <!-- faltou um link aqui-->
            <a href="?p=categoria/consultar" class="btn btn-danger">Voltar</a>
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
            $img->setId_categoria($id_categoria);
            $img->enviarArquivos();
            
            echo $img->salvar() == TRUE ? "Imagem salva com sucesso" : "Erro ao salvar imagem";
        }
    }
}









