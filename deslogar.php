<?php

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

//session_start();

$URL_BASE = "http://$_SERVER[HTTP_HOST]";
     if($URL_BASE=="http://localhost"){
		$diretorioProjeto = "/php-crud";
		$URL_BASE = $URL_BASE.$diretorioProjeto;
	 }


$_SESSION['permissao'] = "NAO";
unset($_SESSION['msgErroExpirou']);
header('Location: '.$URL_BASE.'/login.php');


?>
