<?php


include 'functions.php';
include 'verificaLogin.php';



// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 3;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM minhas_senhas ORDER BY nome LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$senhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_senhas = $pdo->query('SELECT COUNT(*) FROM minhas_senhas')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Senhas</h2>
	<a href="create.php" class="create-contact">Criação de Senha</a>
    <?php
    // VERIFICAR MENSAGEM DE ERRO E SUCESSO DE INTERAÇÕS COM O BANCO
    include '_alert_messagem.php';
   
    ?>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>senha</td>
                
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($senhas as $senha): ?>
            <tr>
                <td><?=$senha['id']?></td>
                <td><?=$senha['nome']?></td>
                <td title="<?=$senha['senha']?>"><?=md5($senha['senha'])?></td>
              
                <td class="actions">
                    <a href="update.php?id=<?=$senha['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$senha['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="senhas.php?verificado=rafadenis&page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_senhas): ?>
		<a href="senhas.php?verificado=rafadenis&page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>