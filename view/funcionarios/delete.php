<?php
include '../../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM funcionarios WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$funcionario) {
        exit('Não existe cliente com esse ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM funcionarios WHERE id = ?');
            $deletou = $stmt->execute([$_GET['id']]);
            if($deletou):
                $msg = 'O FUNCIONÁRIO '.$funcionario['nome'].' '.$funcionario['id'].' foi deletado com Sucesso!';
                session_start();
            
                $_SESSION['msgSucesso'] = $msg;
            else:
                $msg = 'O FUNCIONÁRIO '.$funcionario['nome'].' '.$funcionario['id'].'não foi deletado , pois ocorrreu um erro inesperado';
                session_start();
            
                $_SESSION['msgErro'] = $msg;    
            endif;    
             header('Location: funcionarios.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: funcionarios.php');
            exit;
        }
    }
} else {
    exit('ID NÃO INFORMADO!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Deletar Cliente #<?=$funcionario['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Tem Certeza que deseja deletar o funcionario #<?=$funcionario['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$funcionario['id']?>&confirm=yes">Sim</a>
        <a href="delete.php?id=<?=$funcionario['id']?>&confirm=no">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>