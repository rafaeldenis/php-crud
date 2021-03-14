<?php

include 'functions.php';
include 'verificaLogin.php';
/*if($_SESSION['permissao']!="S"){

    header('Location: login.php');
    exit();
  }*/
?>

<?=template_header('Home')?>
<?php include '_alert_messagem.php'; ?>
<div class="content">
	<h2>Página Inicial</h2>
	<p>Seja bem vindo a página de controle de clientes </p>
</div>

<?=template_footer()?>