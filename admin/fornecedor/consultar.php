<h3 class="mt-3 text-primary">
    Listar Fornecedores
    <a class="btn btn-success float-right" href="?p=fornecedor/salvar">Cadastrar</a>
</h3>

<!-- abaixo vou montar um card com uma table para listar as categorias
    hj apenas faremos o layout, porém na aula de select SQL faremos funcionar -->

    <div class="card shadow">
        <!-- striped é para zebrar as linhas, cada uma com uma cor-->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cep</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                <!--foreach aqui BEGIN-->
                <?php
                //estabelecer conversa com a class Fornecedor
                include_once '../class/Fornecedor.php';
                $fornecedor = new Fornecedor();

                $dados = $fornecedor->consultar();

                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar['id']?></td>
                        <td><?=$mostrar['nome']?></td>
                        <td><?=$mostrar['cep']?></td>
                        <td><?=$mostrar['email']?></td>
                        <td>
                            <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                            <a href="?p=fornecedor/excluir&id=<?=$mostrar['id']?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a>                        

                            <a href="?p=fornecedor/salvar&id=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <a href="?p=imagem/consultar_fornecedor&id_fornecedor=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
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


