<?php


include '../../functions.php';
include '../../verificaLogin.php';

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 3;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM clientes ORDER BY nome LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_clientes = $pdo->query('SELECT COUNT(*) FROM clientes')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Clientes</h2>
	<a href="create.php" class="create-contact">Criação de Cliente</a>
    <?php
    // VERIFICAR MENSAGEM DE ERRO E SUCESSO DE INTERAÇÕS COM O BANCO
    include '../../_alert_messagem.php';
   
    ?>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>apelido</td>
                
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?=$cliente['id']?></td>
                <td><?=$cliente['nome']?></td>
                <td><?=$cliente['apelido']?></td>
              
                <td class="actions">
                    <a href="update.php?id=<?=$cliente['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$cliente['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_clientes): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>