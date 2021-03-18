<?php

include 'functions.php';
//include 'verificaLogin.php';
/*if($_SESSION['permissao']!="S"){

    header('Location: login.php');
    exit();
  }*/

  // Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 100;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM clientes ORDER BY nome LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($clientes);
	        echo($json);
?>