<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SISFAI Coordenador</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <!-- Estilos customizados para esse template -->
        <link href="../css/signin.css" rel="stylesheet">
    </head>

    <body class="text-center bg-light">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4 col-sm-12">&nbsp;</div>
                <div class="col-md-4 col-sm-12">
                    <form class="form-signin" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">SISFAI <br>Coordenador</h1>
                        <div class="col-sm-12">
                            <div class="checkbox mb-3">
                                <label for="inputEmail" class="sr-only">Matrícula</label>
                                <input type="number" id="inputEmail" name="txtmatricula" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="checkbox mb-3">
                                <label for="inputPassword" class="sr-only">Senha</label>
                                <input type="password" id="inputPassword" name="txtsenha" class="form-control" placeholder="Senha" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" name="btnacessar" class="btn btn-lg btn-primary btn-block" valeu="Login">
                            <a href="../index.php" class="btn btn-lg btn-link btn-block"><< Voltar</a>
                            <p class="mt-2 mb-3 text-muted">&copy; 2022</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


<?php
if (filter_input(INPUT_POST, 'btnacessar')) {
//recebendo dados do form
    $matricula = filter_input(INPUT_POST, 'txtmatricula', FILTER_SANITIZE_NUMBER_INT);
    $senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);

    //acesso a table no MySQL
    include_once '../class/Usuario.php';
    $user = new Usuario();

    $user->setMatricula($matricula);
    $user->setSenha($senha);

    if (count($user->consultar()) <= 0) {
        echo '<div class="container">'
        . '<div class="alert alert-warning" role="alert">'
        . '<h3>Matrícula e/ou senha incorreto(s)</h3>'
        . '<p>Verifique sua matrícula e senha!</p>'
        . '</div>'
        . '</div>';
    } else {
        foreach ($user->consultar() as $mostrar) {
            //$nivel = $mostrar[3];
            $matricula = $mostrar[0];
        }
        session_start();
        $_SESSION['acesso'] = '7a85f4764bbd6daf1c3545efbbf0f279a6dc0beb';
        //$_SESSION['nivel'] = $nivel;
        $_SESSION['matricula'] = $matricula;

        //redireciona página
        header("location:index.php");
    }
}



