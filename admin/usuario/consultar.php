<h3 class="mt-3 text-primary">
    Listar Usuários
    <a class="btn btn-success float-right" href="?p=usuario/salvar">Cadastrar</a>
</h3>

<!-- abaixo vou montar um card com uma table para listar as categorias
    hj apenas faremos o layout, porém na aula de select SQL faremos funcionar -->

<div class="card shadow">
    <!-- striped é para zebrar as linhas, cada uma com uma cor-->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!--foreach aqui BEGIN-->
            <?php
            //estabelecer conversa com a class Usuário
            include_once '../class/Usuario.php';
            $user = new Usuario();

            $dados = $user->consultar();

            foreach ($dados as $mostrar) {
            ?>
                <tr>
                    <td><?= $mostrar['matricula'] ?></td>
                    <td><?= $mostrar['senha'] ?></td>
                    <td>
                        <!--MODAL já está pronto no JS, exemplos de modal em Bootstrap-->
                        <a href="?p=usuario/excluir&id=<?= $mostrar['matricula'] ?>" class="btn btn-danger" data-confirm="Excluir registro?">
                            <i class="bi bi-trash-fill"></i>
                        </a>

                        <a href="?p=usuario/salvar&id=<?= $mostrar['matricula'] ?>" class="btn btn-primary ml-2">
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