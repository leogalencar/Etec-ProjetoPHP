<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Categoria.php';
$cat = new Categoria();

$cat->setId($id);
?>
<div class="alert alert-danger" role="alert">
    <?= $cat->excluir() ?>
</div>
<meta http-equiv="refresh" content="1;URL=?p=categoria/consultar">
