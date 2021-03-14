<?php


include 'functions.php';
$URL_BASE = "http://$_SERVER[HTTP_HOST]";
     if($URL_BASE=="http://localhost"){
		$diretorioProjeto = "/php-crud";
		$URL_BASE = $URL_BASE.$diretorioProjeto;
	 }


?>

<?=template_header('Read')?>

<div class="container">
    
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Faça Login</h5>
            <a class="nav-link" href="<?php echo $URL_BASE?>/create_usuario.php"><i class="fas fa-user-plus"></i> Criar Usuário </a>
            <?php include '_alert_messagem.php'; ?>
            <div class="content update">
	
    <form action="logar.php" method="post">
       
        <div class="form-group">
            <label for="email" class_font_rotulo>Usuário</label>
            <label for="email"></label>

            <input type="email" name="email" placeholder="pamonha" id="email">
           
        </div>
        <div class="form-group">
            <label for="senha" class_font_rotulo>Senha</label>
            <label for="senha"></label>

            <input type="password" name="senha" placeholder="*******" id="senha">
           
        </div>
        <div class="form-group">
            <label for="salvar"></label>
        

            <input type="submit" value="Logar" id="salvar" name="salvar">
       
        </div>      
      
    </form>
   
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<?=template_footer()?>