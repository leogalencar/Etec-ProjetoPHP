<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Fornecedor.php';
$fornecedor = new Fornecedor();

$fornecedor->setId($id);
?>
<div class="alert alert-danger" role="alert">
    <?= $fornecedor->excluir() ?>
</div>
<meta http-equiv="refresh" content="0.5;URL=?p=fornecedor/consultar">
