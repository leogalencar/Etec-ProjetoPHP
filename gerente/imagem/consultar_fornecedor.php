<?php include_once 'cabecalho.php'; ?>

<?php
$id_fornecedor = filter_input(INPUT_GET, 'id_fornecedor');

include_once '../class/Imagem_Fornecedor.php';
$img = new Imagem();
$img->setId_fornecedor($id_fornecedor);
$dados = $img->consultar();

foreach ($dados as $mostrar) {
    $nome = $mostrar['nome'];
    break;
}
?>

<h3 class="mt-3 text-primary">
    Listar Imagens do Fornecedor<br> (<?= isset($nome) ? $nome : "" ?>)
    <a class="btn btn-danger float-right ml-3" href="?p=fornecedor/consultar">Voltar</a>
    <a class="btn btn-primary float-right" href="?p=imagem/salvar_fornecedor&id_fornecedor=<?= $id_fornecedor ?>">Cadastrar</a>
</h3>

    <div class="card shadow">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                <?php
                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar[0]?></td>
                        <td><img src="../img/<?=$mostrar['endereco']?>" style="width: 100px;"></td>
                        <td>
                            <a href="?p=imagem/excluir&id=<?=$mostrar[0]?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a> 
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>


