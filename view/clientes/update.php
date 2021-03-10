<?php
include '../../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $apelido = isset($_POST['apelido']) ? $_POST['apelido'] : '';
       
        $stmt = $pdo->prepare('UPDATE clientes SET id = ?, nome = ?, apelido = ? WHERE id = ?');
        $gravou = $stmt->execute([$id, $nome, $apelido, $_GET['id']]);

        if($gravou):
            $msg = 'O CLEINTE '.$nome.' '.$id.' foi atualizado com Sucesso!';
            session_start();
        
            $_SESSION['msgSucesso'] = $msg;
        else:
            $msg = 'O CLEINTE '.$nome.' '.$id.' não foi atualizado , pois ocorrreu um erro inesperado';
            session_start();
        
            $_SESSION['msgErro'] = $msg;    
        endif;    
        header('Location: read.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM clientes WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$cliente) {
        exit('Não existe contato com esse Id!');
    }
} else {
    exit('Nenhum Id especificado, por favor verifique!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Editar Cliente #<?=$cliente['id']?></h2>
    <form action="update.php?id=<?=$cliente['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" readonly name="id" placeholder="1" value="<?=$cliente['id']?>" id="id">
        <input type="text" name="nome" placeholder="John Doe" value="<?=$cliente['nome']?>" id="nome">
        <label for="apelido">Apelido</label>
        <label for=""></label>
        <input type="text" name="apelido" placeholder="johndoe@example.com" value="<?=$cliente['apelido']?>" id="apelido">
     
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>