<?php include_once 'cabecalho.php'; ?>

<h3 class="mt-3 text-primary">
    Listar Produtos
    <a class="btn btn-success float-right" href="?p=produto/salvar">Cadastrar</a>
</h3>

    <div class="card shadow">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                <!--foreach BEGIN-->
                <?php
                include_once '../class/Produto.php';
                
                $prod = new Produto();
                $dados = $prod->consultar();

                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar['id']?></td>
                        <td><?=$mostrar['nome']?></td>
                        <td><?=$mostrar['descricao']?></td>
                        <td><?=$mostrar['preco']?></td>
                        <td>
                            <a href="?p=produto/excluir&id=<?=$mostrar['id']?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a>                        

                            <a href="?p=produto/salvar&id=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <a href="?p=imagem/salvar&id_produto=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
                                <i class="bi bi-card-image"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <!--foreach END-->
            </tbody>
        </table>
    </div>


