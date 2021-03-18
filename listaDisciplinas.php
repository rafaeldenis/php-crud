<?php


include 'functions_oracle.php'; 
//include 'verificaLogin.php';

// Connect to MySQL database
//$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10; 

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
//$stmt = $pdo->query("SELECT * FROM ACADEMICO.PG_DISCIPLINAS  ORDER BY DESCRICAO");
$stmt = $pdo->query("SELECT * FROM ACADEMICO.PG_DISCIPLINAS  ORDER BY DESCRICAO");
// Fetch the records so we can display them in our template.
$disciplinas = $stmt->fetchAll(PDO::FETCH_ASSOC); 

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_disciplinas= $pdo->query('SELECT COUNT(*) FROM ACADEMICO.PG_DISCIPLINAS')->fetchColumn();
?>

<?=template_header('Disciplinas')?> 

<div class="content read">
	<h2>Lista Disciplinas  </h2>

	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Descricao</td>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disciplinas as $disciplina): ?>
            <tr>
                <td><?=$disciplina['CODIGO']?></td>
                <td><?=utf8_encode($disciplina['DESCRICAO'])?></td>              
                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="listaDisciplinas.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*3 < $num_disciplinas): ?>
		<a href="listaDisciplinas.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>