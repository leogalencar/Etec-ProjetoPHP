<h3 class="mt-3 text-primary">
    Listar Categorias
    <a class="btn btn-success float-right" href="?p=categoria/salvar">Cadastrar</a>
</h3>

<!-- abaixo vou montar um card com uma table para listar as categorias
    hj apenas faremos o layout, porém na aula de select SQL faremos funcionar -->

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
                include_once '../class/Categoria.php';
                $cat = new Categoria();

                $dados = $cat->consultar();

                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar['id']?></td>
                        <td><?=$mostrar['descricao']?></td>
                        <td>
                            <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                            <a href="?p=categoria/excluir&id=<?=$mostrar['id']?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a>                        

                            <a href="?p=categoria/salvar&id=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <a href="?p=imagem/consultar&id_categoria=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
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


