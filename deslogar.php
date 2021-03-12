<?php

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

session_start();

$_SESSION['permissao'] = "NAO";

header('Location: '.$URL_BASE.'/login.php');


?>
