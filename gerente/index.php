<?php include_once 'cabecalho.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Aula exemplo - PHP</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        /*css aqui*/
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row mb-3">
            <!--
                1. CRIAMOS A ESTRUTURA DE PASTAS DO ADMIN, VERIFIQUE AS PASTAS E ARQUIVOS DESSE PROJETO
                2. VEJA COMO CRIAMOS OS LINKS NO NAVBAR, INDICAMOS P= QUE É UMA VARIÁVEL NO ENDEREÇO, ESTA VARIÁVEL ALTERNA SEU CONTEÚDO, CONFORME SE CLICA NAS OPÇÕES DO NAVBAR
                -->

            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand">PROJETO PHP 3 DS</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="?p=pagina-principal">Página Inicial</a>
                            <a class="nav-item nav-link" href="?p=categoria/consultar">Categoria</a>
                            <a class="nav-item nav-link" href="?p=cliente/consultar">Cliente</a>
                            <a class="nav-item nav-link" href="?p=produto/consultar">Produto</a>
                            <a class="nav-item nav-link" href="?p=fornecedor/consultar">Fornecedor</a>
                            <a class="nav-item nav-link" href="?p=usuario/consultar">Usuários</a>
                            <a class="nav-item nav-link" href="logout.php">Sair</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row m-5">
            <div class="col-12">
                <!--
                    ESSE É CÓDIGO PHP PARA CHAMAR AS OUTRAS PÁGINAS (PERCEBA QUE AS OUTRAS PÁGINAS NÃO POSSUEM HEAD, NAVBAR...APENAS O PRÓPRIO CONTEÚDO.
                    
                    O CÓDIGO ABAIXO:
                    1. GET PEGA O VALOR DA VARIÁVEL P DO ENDEREÇO
                    2. VERIFICA SE É A PRIMEIRA VEZ QUE ENTRO NO ADMIN OU SE O USUÁRIO FORÇOU INDEX NO ENDEREÇO
                    SE SIM CARREGA PAGINA-PRINCIPAL
                    SE NÃO CARREGA A PÁGINA INDICADA PELO NAVBAR (VERIFICA SE O ARQUIVO EXISTE OU SE MOSTRA ERRO 404)
                    
                    -->
                <?php
                $pagina = filter_input(INPUT_GET, 'p');

                if ($pagina == '' || empty($pagina) || $pagina == 'index' || $pagina == 'index.php') {
                    include_once 'pagina-principal.php';
                } else {
                    if (file_exists($pagina . '.php')) {
                        include_once $pagina . '.php';
                    } else {
                        echo '<div class="col-12">'
                            . '<div class="alert alert-danger" role="alert">'
                            . '<h3>Erro 404</h3>'
                            . '<p>Página não encontrada!</p>'
                            . '</div>'
                            . '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    <script src="../js/script.js"></script>
    <script type="text/javascript">
        //aqui js
    </script>
</body>

</html>