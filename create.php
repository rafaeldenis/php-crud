<?php

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
     
    //print_r($_POST);
    
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $apelido = isset($_POST['apelido']) ? $_POST['apelido'] : '';
 
    $stmt = $pdo->prepare('INSERT INTO clientes VALUES (?,?,?)');
    $gravou = $stmt->execute([$id,$nome, $apelido ]);
    if($gravou):
        $msg = 'O CLEINTE '.$nome.' '.$id.' foi gravado com Sucesso!';
        session_start();
    
        $_SESSION['msgSucesso'] = $msg;
    else:
        $msg = 'O CLIENTE '.$nome.' '.$id.' não foi gravado , pois ocorrreu um erro inesperado';
        session_start();
    
        $_SESSION['msgErro'] = $msg;    
    endif;  
    header('Location: read.php');   
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Criar contato ->  <a href="read.php"><i class="fas fa-address-book"></i>Voltar</a> </h2>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <label for="nome" class='class_font_rotulo'>nome</label>
            <input type="text" name="id" placeholder="26" readonly value="auto" id="id">
            
            <input type="text" name="nome" placeholder="John Doe" id="nome" required="S" >
            <div id="div_error_nome" class="class_error"></div>
             
        </div>  
        <div class="form-group">
            <label for="apelido" class_font_rotulo>Apelido</label>
            <label for="apelido"></label>

            <input type="text" name="apelido" placeholder="pamonha" id="apelido">
           
        </div>
        <div class="form-group">
            <label for="salvar"></label>
        

            <input type="submit" value="Create" id="salvar" name="salvar">
       
        </div>      
      
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>

<script>



$("#salvar").click(function(){

// remove as mensagens de erro
$(".erromsg").remove();

// verificar se os campos foram preenchidos
var nome = $("#nome");
var apelido = $("#apelido");


// Mensagem de erro padrão a ser inserida após o campo
var erromsg = '<div class="erromsg">Preencha o campo <span></span></div>';
$("#apelido").css('border-color', '');  
$("#nome").css('border-color', '');  
if(!nome.val() || nome.val().length < 5){
   nome.after(erromsg);
   $(".erromsg span").text("nome corretamente");
   //$("#nome").addClass("campo-errado");
   $("#nome").css('border-color', 'red');

   return false;
}else{
    $("#nome").css('border-color', '');   
     
}

if(!apelido.val() || apelido.val().length < 5){
    apelido.after(erromsg);
   $(".erromsg span").text("apelido corretamente");
   $("#apelido").css('border-color', 'red');  
   return false;
}else{
    $("#apelido").css('border-color', '')  
}

});

</script>