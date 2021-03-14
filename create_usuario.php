<?php

include 'functions.php';

$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty

//print_r($_POST);
if (!empty($_POST)) {
     //echo "aqui";
   
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    //$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    
    $cpf_cnpj = isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    if(!empty($_POST['nome'])){
       $nome =  $_POST['nome'];
    }else{
        $nome = null;
    }

    if(!empty($_POST['senha'])){
        $senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
     }else{
         $senha = null;
     }

    //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE
  // exit();
  
    $stmt = $pdo->prepare('INSERT INTO usuarios VALUES (?,?,?,?,?)');
    $gravou = $stmt->execute([$id, $nome, $email, $senha, $cpf_cnpj]);
    if($gravou):

        $URL_BASE = "http://$_SERVER[HTTP_HOST]";
        if($URL_BASE=="http://localhost"){
            $diretorioProjeto = "/php-crud";
            $URL_BASE = $URL_BASE.$diretorioProjeto;
        }

        session_start();
    
        $msg = 'O USUÁRIO '.$nome.' '.$id.' foi gravado com Sucesso!';
        
        $_SESSION['msgSucesso'] = $msg;

        header('Location: '.$URL_BASE.'/listaUsuarios.php');
        
        exit();
        
    else:
        $msg = 'O USUÁRIO '.$nome.' '.$id.' não foi gravado , pois ocorrreu um erro inesperado';
        //session_start();
    
        $_SESSION['msgErro'] = $msg;    
    endif;  
     
  
}
?>


<?=template_header('Create')?>

<div class="content update">
    <?php include '_alert_messagem.php'; ?>
    
    <a class="nav-link" href="index.php"><i class="fas fa-arrow-alt-circle-left"></i> Voltar</a>
    <h2>Criar Novo Usuário</h2>
    
    <form action="create_usuario.php" method="post">
        
    <label for="id">ID</label>
        <label for="nome">nome</label>
        <input type="text" name="id" placeholder="26" readonly value="auto" id="id">
        <input type="text" name="nome" placeholder="John Doe" id="nome" required>
        <label for="email">Email/User</label>
        <label for="nome">CPF</label>
        <input type="email" name="email" placeholder="rafafa@.com.br" id="email" required>


        <input type="text" class="validate"name="cpf_cnpj" placeholder="xxx.xxx.xxx.-34" id="cpf_cnpj" required>
            <div id="div_error_cpf_cnpj" class="class_error"></div>
        <label for="senha">Senha</label>
        <label for=""></label>
        <input type="password" name="senha" placeholder="*******" id="senha" required>
        <div id="div_error_senha" class="class_error"></div>
             
        <label for="apelido"></label>
        <label for="apelido"></label>

       


        <label for="salvar"></label>
       

        <input type="submit" value="Create" id="salvar" name="salvar">
    </form>
   
   
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

