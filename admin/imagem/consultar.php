<?php
$id_categoria = filter_input(INPUT_GET, 'id_categoria');

include_once '../class/Imagem.php';
$img = new Imagem();
$img->setId_categoria($id_categoria);
$dados = $img->consultar();

foreach ($dados as $mostrar) {
    $descricao = $mostrar['descricao'];
    break;
}
?>

<h3 class="mt-3 text-primary">
    Listar Imagens da Categoria<br> (<?= isset($descricao) ? $descricao : "" ?>)
    <a class="btn btn-danger float-right ml-3" href="?p=categoria/consultar">Voltar</a>
    <a class="btn btn-primary float-right" href="?p=imagem/salvar&id_categoria=<?= $id_categoria ?>">Cadastrar</a>
</h3>

    <div class="card shadow">
        <!-- striped é para zebrar as linhas, cada uma com uma cor-->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                <!--foreach aqui BEGIN-->
                <?php
                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar[0]?></td>
                        <td><img src="../img/<?=$mostrar['endereco']?>" style="width: 100px;"></td>
                        <td>
                            <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                            <a href="?p=imagem/excluir&id=<?=$mostrar[0]?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a> 
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <!--foreach aqui END-->
            </tbody>
        </table>
    </div>


