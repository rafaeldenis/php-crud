<?php
include '../../functions.php';
$pdo = pdo_connect_mysql();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $cpf_cnpj = isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : '';
        $salario = isset($_POST['salario']) ? $_POST['salario'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
       
        
        $stmt = $pdo->prepare('UPDATE funcionarios SET nome = ?, email = ?, salario = ?,cpf_cnpj = ? WHERE id = ?');
      
        
        
        try {
        $gravou = $stmt->execute([$nome, $email, $salario, $cpf_cnpj, $_GET['id']]);
        $msg = 'O FUNCIONÁRIO '.$nome.' '.$id.' foi atualizado com Sucesso!';
        session_start();    
        $_SESSION['msgSucesso'] = $msg;
        } catch (PDOException $e) {
            $error =  $e->getMessage();
            $msg = 'O FUNCIONÁRIO '.$nome.' '.$id.' não foi atualizado , pois ocorrreu um erro inesperado '.$error.'';
            session_start();        
            $_SESSION['msgErro'] = $msg;    
        }
 
        header('Location: funcionarios.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM funcionarios WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$funcionario) {
        exit('Não existe contato com esse Id!');
    }
} else {
    exit('Nenhum Id especificado, por favor verifique!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Editar Funcionario#<?=$funcionario['id']?></h2>
    <form action="update.php?id=<?=$funcionario['id']?>" method="post">
    <label for="id">ID</label>
        <label for="nome">nome</label>
        <input type="text" name="id" placeholder="26" readonly value="auto" id="id">
        <input type="text" name="nome" placeholder="John Doe" id="nome" value="<?=$funcionario['nome']?>">
        <label for="id">Salário</label>
        <label for="nome">CPF</label>
        <input type="number" name="salario" placeholder="3500"  value="<?=$funcionario['salario']?>" id="salario">
        <input type="text" class="validate"name="cpf_cnpj" placeholder="xxx.xxx.xxx.-34" id="cpf_cnpj" value="<?=$funcionario['cpf_cnpj']?>">
        <label for="apelido">email</label>
        <label for="apelido"></label>

        <input type="text" name="email" placeholder="rafafa@.com.br" id="email" value="<?=$funcionario['email']?>">


        <label for="salvar"></label>
       

        <input type="submit" value="Salvar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>