<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Cliente.php';
$cli = new Cliente();

$cli->setId($id);
?>
<div class="alert alert-danger" role="alert">
    <?= $cli->excluir() ?>
</div>
<meta http-equiv="refresh" content="0.5;URL=?p=cliente/consultar">
