<?php include_once 'cabecalho.php'; ?>

<h3 class="mt-3 text-primary">
    Listar Clientes
    <a class="btn btn-success float-right" href="?p=cliente/salvar">Cadastrar</a>
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
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Vídeo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                <!--foreach aqui BEGIN-->
                <?php
                //estabelecer conversa com a class Cliente
                include_once '../class/Cliente.php';
                $cli = new Cliente();

                $dados = $cli->consultar();

                foreach ($dados as $mostrar) { 
                    ?>
                    <tr>
                        <td><?=$mostrar['id']?></td>
                        <td><?=$mostrar['nome']?></td>
                        <td><?=$mostrar['email']?></td>
                        <td><?=$mostrar['telefone']?></td>
                        <td>
                        <iframe width="224" height="126" src="https://www.youtube.com/embed/<?=$mostrar['video']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </td>
                        <td>
                            <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                            <a href="?p=cliente/excluir&id=<?=$mostrar['id']?>" class="btn btn-danger" data-confirm="Excluir registro?">
                                <i class="bi bi-trash-fill"></i>
                            </a>                        

                            <a href="?p=cliente/salvar&id=<?=$mostrar['id']?>" class="btn btn-primary ml-2">
                                <i class="bi bi-pencil-fill"></i>
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


