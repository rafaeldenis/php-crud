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

	 $permissao = $_SESSION['permissao'];
	 $usuarioLogado = $_SESSION['usuarioLogado'];
	
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		
		<link href="../../style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
	</head>
	<body>
	<header class="cabecalho">
		<center>
		<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#003300">
			<tr>
				<td align="left" width="100%">
					<a href="http://www.unifesp.br" target="_top" title="Universidade Federal de São Paulo"><img src="/img/titulo_unifesp.gif" border="0"></a>
				</td>
																		
														
			</tr>
		</table>
		</center>
		<nav class="navtop">
	
    	<div>
    		<h1>Sistema de Gereciamento de Clientes </h1>		
            <a href="$URL_BASE/index.php"><i class="fas fa-home"></i>Página Principal</a>
    		<a href="$URL_BASE/view/clientes/read.php"><i class="fas fa-address-book"></i>Clientes</a>
    		<a href="$URL_BASE/view/funcionarios/funcionarios.php"><i class="fas fa-address-book"></i>Funcionários</a>
    		<a id="myAnchor" href="#" onclick=adicionarItem();><i class="fas fa-address-book"></i>senhas</a>
    		
    		
    	</div>
    </nav>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0C1E25;">
            <div class="d-flex justify-content-start align-items-center nome-nav">
                <figure>
                    <img src="imagem-eout-removebg-preview.png" href="#" class="navbar-brand imagem-nav">
                </figure>
                <h1><a class="navbar-brand" href="#">E-Out</a></h1>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Home</a>
                <a class="nav-item nav-link" href="#">Eventos</a>
                <a class="nav-item nav-link" href="#">Quem somos</a>
              </div>
            </div>
        </nav>  


		
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


<script>

function adicionarItem(){
	 
	    var senha = "101947";
        var item = prompt("Qual objeto você deseja incluir na lista?", "");
	  
		if(item == null || item == "") {
            alert("O uso do prompt foi cancelado!");
			$('#myAnchor').attr('href', 'http://localhost:81/index.php')
			//$(location).attr('href', 'funcionarios.php');
			
        }else {           
		
			if(senha==item){	
			    parametro = "rafadenis";
			    parametro =  encodeURIComponent(parametro);
				$('#myAnchor').attr('href', 'http://localhost:81/senhas.php?verificado='+parametro+'');
			}else{
				
				$('#myAnchor').attr('href', 'http://localhost:81/index.php')	
			}
			


			
        }
    }

	<?php echo rand(1, 1000);?>

</script>