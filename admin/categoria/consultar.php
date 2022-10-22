<?php
include_once 'cabecalho.php';

// PÁGINAÇÃO
//total de registros por página
$total_reg = "10";

$pagina = filter_input(INPUT_GET, 'pagina');
//página atual
$pc = (!$pagina) ? 1 : $pagina;

//detrmina o inicio do registros numa determinada página
$inicio = ($pc - 1) * $total_reg;

include_once '../class/Categoria.php';
$cat = new Categoria();

$dados = $cat->paginar($inicio, $total_reg);
?>

<h3 class="mt-3 text-primary">
    Listar Categorias
    <a class="btn btn-success float-right" href="?p=categoria/salvar">Cadastrar</a>
</h3>

<?php

$tr = count($cat->consultar());
$tp = $tr / $total_reg;

$anterior = $pc - 1;
$proximo = $pc + 1;

if ($pc > 1) {
    $passo_ant = $anterior;
}

if ($pc < $tp) {
    $passo_prox = $proximo;
}

?>

<!-- abaixo vou montar um card com uma table para listar as categorias
    hj apenas faremos o layout, porém na aula de select SQL faremos funcionar -->

<div class="col-sm-12">
    <nav aria-label="..." class="mb-3">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $pc == 1 ? "disabled" : "" ?>">
                <a class="page-link" href="?p=categoria/consultar&pagina=<?= $passo_ant ?>" tabindex="-1">Anterior</a>
            </li>
            <?php
            for ($i = 1; $i <= ($tp + 1); $i++) {
                (!$pagina) ? $pagina = 1 : "";
            ?>

                <li class="page-item  <?= $pagina == $i ? "active" : "" ?>"><a class="page-link" href="?p=categoria/consultar&pagina=<?= $i ?>"><?= $i ?></a></li>
            <?php
            }
            ?>
            <li class="page-item <?= $pc > $tp ? "disabled" : "" ?>">
                <a class="page-link" href="?p=categoria/consultar&pagina=<?= $passo_prox ?>">Próximo</a>
            </li>
        </ul>
    </nav>
</div>
<div class="card shadow">
    <!-- striped é para zebrar as linhas, cada uma com uma cor-->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!--foreach aqui BEGIN-->
            <?php
            //estabelecer conversa com a class Categoria


            foreach ($dados as $mostrar) {
            ?>
                <tr>
                    <td><?= $mostrar['id'] ?></td>
                    <td><?= $mostrar['descricao'] ?></td>
                    <td>
                        <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                        <a href="?p=categoria/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?">
                            <i class="bi bi-trash-fill"></i>
                        </a>

                        <a href="?p=categoria/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary ml-2">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <a href="?p=imagem/consultar&id_categoria=<?= $mostrar['id'] ?>" class="btn btn-primary ml-2">
                            <i class="bi bi-card-image"></i>
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