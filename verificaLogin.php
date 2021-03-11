<?php
//include 'functions.php';
//session_start();
$URL_BASE = "http://$_SERVER[HTTP_HOST]";
     if($URL_BASE=="http://localhost"){
		$diretorioProjeto = "/php-crud";
		$URL_BASE = $URL_BASE.$diretorioProjeto;
	 }

if(isset($_SESSION['permissao'])){
  
  if($_SESSION['permissao']=="NAO"){

    header('Location: '.$URL_BASE.'/login.php');
    exit();
  }
}




?>
