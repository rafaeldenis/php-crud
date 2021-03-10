<?php

include '../../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
     
   
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $salario = isset($_POST['salario']) ? $_POST['salario'] : '';
    $cpf_cnpj = isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
 
    $stmt = $pdo->prepare('INSERT INTO funcionarios VALUES (?,?,?,?,?)');
    $gravou = $stmt->execute([$id, $nome, $email, $salario, $cpf_cnpj]);
    if($gravou):
        $msg = 'O Funcionário '.$nome.' '.$id.' foi gravado com Sucesso!';
        session_start();
    
        $_SESSION['msgSucesso'] = $msg;
    else:
        $msg = 'O FUNCIONÁRIO '.$nome.' '.$id.' não foi gravado , pois ocorrreu um erro inesperado';
        session_start();
    
        $_SESSION['msgErro'] = $msg;    
    endif;  
    header('Location: funcionarios.php');   
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Criar contato ->  <a href="funcionarios.php"><i class="fas fa-address-book"></i>Voltar</a> </h2>
    <form action="create_funcs.php" method="post">
        <label for="id">ID</label>
        <label for="nome">nome</label>
        <input type="text" name="id" placeholder="26" readonly value="auto" id="id">
        <input type="text" name="nome" placeholder="John Doe" id="nome">
        <label for="id">Salário</label>
        <label for="nome">CPF</label>
        <input type="number" name="salario" placeholder="3500"  value="" id="salario">
        <input type="text" class="validate"name="cpf_cnpj" placeholder="xxx.xxx.xxx.-34" id="cpf_cnpj">
        <label for="apelido">email</label>
        <label for="apelido"></label>

        <input type="text" name="email" placeholder="rafafa@.com.br" id="email">


        <label for="salvar"></label>
       

        <input type="submit" value="Create">
       
            
        </a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>



 <script>
 
 $(document).ready(function () { 
    $('.validate').cpfcnpj({
                mask: true,
                validate: 'cpfcnpj',
                event: 'click',
                //validateOnlyFocus: true,
                handler: '.btn',
                ifValid: function (input) { input.removeClass("error"); alert(returnType); },
                ifInvalid: function (input) { input.addClass("error"); alert(returnType); }
            });
    });
 </script>

