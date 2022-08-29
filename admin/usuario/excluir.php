<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Usuario.php';
$user = new Usuario();

$user->setMatricula($id);
?>
<div class="alert alert-danger" role="alert">
    <?= $user->excluir() ?>
</div>
<meta http-equiv="refresh" content="0.5;URL=?p=usuario/consultar">
