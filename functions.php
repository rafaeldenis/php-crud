<?php
session_start();
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '123';
    $DATABASE_NAME = 'rafael';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
	

	$URL_BASE = "http://$_SERVER[HTTP_HOST]";
     if($URL_BASE=="http://localhost"){
		$diretorioProjeto = "/php-crud";
		$URL_BASE = $URL_BASE.$diretorioProjeto;
	 }

     if(isset($_SESSION['permissao'])){
		$permissao = isset($_SESSION['permissao'])? addslashes(trim($_SESSION['permissao'])) : FALSE;

	 }	

	 if(isset($_SESSION['usuarioLogado'])){
		$usuarioLogado = $_SESSION['usuarioLogado'];
	 }	

	 $usuarioLogado = isset($_SESSION['usuarioLogado'])? addslashes(trim($_SESSION['usuarioLogado'])) : FALSE;

	 

	 //ini_set('session.use_trans_sid', 0);

     if (!isset($_SESSION['permissao'])){
	   $_SESSION['permissao'] = "NAO";	 
       $_SESSION['name']="Guest";

     }

     if ($_SESSION['permissao']!="Guest"){
        $counter = time();

        if (!isset($_SESSION['count'])){
          $_SESSION['count']= $counter;
        }

        if ($counter - $_SESSION['count'] >= 1800 ){
			
			$_SESSION['permissao'] = "NAO";
			$msg = "Seu Usuário expirou por inatividade maior que 30 minutos, Entre Novamente!";
			$_SESSION['msgErroExpirou'] = $msg;
			header('Location: '.$URL_BASE.'/login.php'); 

       }
        $_SESSION['count']= $counter;

     } 
	
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		
		<link href="$URL_BASE/css/style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
	</head>
	<body>
	<header class="cabecalho">
		<center>
		<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#003300">
			<tr>
				<td align="left" width="100%">
					<a href="http://www.unifesp.br" target="_top" title="Universidade Federal de São Paulo"><img src="$URL_BASE/img/titulo_unifesp.gif" border="0"></a>
				</td>
																		
														
			</tr>
		</table>
		</center>
		<nav class="navtop">
	
    	<div>
    		<h1> Gerenciamento Clientes  </h1>		
            <a href="$URL_BASE/index.php"><i class="fas fa-home"></i>Página Principal</a>
            <a href="#"><i class="fas fa-smile"></i> $usuarioLogado </a>
            <a href="$URL_BASE/deslogar.php"><i class="fas fa-power-off"></i> Sair </a>
            <a href="$URL_BASE/form_email.php"><i class="fas fa-headphones"></i> Fale Conosco </a>

    	
    		
    		
    	</div>
    </nav>
	<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
     
        <li class="nav-item">
            <a class="nav-link" id="profile-tab"  href="$URL_BASE/view/clientes/read.php"  aria-selected="false"><i class="fas fa-users"></i> Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="$URL_BASE/view/funcionarios/funcionarios.php" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-address-book"></i> Funcionários</a>
        </li>
		<li class="nav-item">
			<a class="nav-link" id="myAnchor" href="$URL_BASE/senhas.php" onclick=adicionarItem(); data-toggle="tab"  role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-key"></i> Senhas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="myAnchor" href="$URL_BASE/listaUsuarios.php" onclick=adicionarItem(); data-toggle="tab"  role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-user-secret"></i>Usuários</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" id="myAnchor" href="$URL_BASE/form_email.php" onclick=adicionarItem(); data-toggle="tab"  role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-headphones"></i> Fale Conosco</a>
		</li>
		
    </ul>
   
</div>	
	
	</header>    
EOT;
}
function template_footer() {
echo <<<EOT

    </body>
</html>
EOT;
}
?>
