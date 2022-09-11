<?php

date_default_timezone_set('America/Sao_Paulo');
(!isset($_SESSION)) ? session_start() : "";
$nivel = 1; //0,1 ou 2

if ($_SESSION['acesso'] != '1101cb047b73622bb692a730f0eb01de86daeceb' or $_SESSION['nivel'] < $nivel) {
    header("location:logout.php");
}
if (!isset($_SESSION['start_login'])) {
    $_SESSION['start_login'] = time();
    $_SESSION['logout_time'] = $_SESSION['start_login'] + (3600); //15minutos
}
if (time() >= $_SESSION['logout_time']) {
    header("location:logout.php");
}
