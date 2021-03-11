<?php
//include 'functions.php';
//session_start();
if(isset($_SESSION['permissao'])){
  
  if($_SESSION['permissao']=="NAO"){

    header('Location: http://localhost:81/login.php');
    exit();
  }
}




?>
