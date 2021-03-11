<?php


include 'functions.php';





?>

<?=template_header('Read')?>

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Faça Login</h5>
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