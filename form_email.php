<?php


include 'functions.php';
$URL_BASE = "http://$_SERVER[HTTP_HOST]";
     if($URL_BASE=="http://localhost"){
		$diretorioProjeto = "/php-crud";
		$URL_BASE = $URL_BASE.$diretorioProjeto;
	 }


?>

<?=template_header('Read')?>

<div class="row">
<div class="col-sm-6">

<!-- Aqui abro a tag form e defino a action e o metodo a ser enviado Action = Página destino Method = Post (envia o código de maneira "não visível na url" -->

<form action="email.php" method="post"><!-- input do formulario -->
<div class="row">
<div class="col-sm-12"><input id="empresa" class="form-control" name="empresa" required="" type="text" placeholder="Empresa" /></div>
</div>
<div class="row">
<div class="col-sm-12"><input id="nome" class="form-control" name="nome" required="" type="text" placeholder="Nome" /></div>
</div>
<div class="row">
<div class="col-sm-6"><input id="telefone" class="form-control" name="telefone" required="" type="text" placeholder="Telefone" /></div>
<div class="col-sm-6"><input id="email" class="form-control" name="email" required="" type="email" placeholder="email" /></div>
</div>
<div class="row">
<div class="col-sm-12"><textarea id="mensagem" class="form-control" name="mensagem" required="" placeholder="mensagem">    </textarea></div>
</div>
<div class="row">
<div class="col-sm-12"><button class="btn btn-dark" type="submit">Enviar</button></div>
</div>
</form></div>
<div class="col-sm-6">
<h5>Telefone</h5>
11 99999-9999

<hr />

<h5>E-mail</h5>
mariones@mariones.com.br

<hr />

<button class="btn btn-dark">Ver Mapa</button>

</div>
</div>
</div>
<?=template_footer()?>