<?php

date_default_timezone_set('America/Sao_Paulo');
(!isset($_SESSION)) ? session_start() : "";
$nivel = 2; //0,1 ou 2

if ($_SESSION['acesso'] != '7a85f4764bbd6daf1c3545efbbf0f279a6dc0beb' or $_SESSION['nivel'] < $nivel) {
    header("location:logout.php");
}
if (!isset($_SESSION['start_login'])) {
    $_SESSION['start_login'] = time();
    $_SESSION['logout_time'] = $_SESSION['start_login'] + (3600); //15minutos
}
if (time() >= $_SESSION['logout_time']) {
    header("location:logout.php");
}
