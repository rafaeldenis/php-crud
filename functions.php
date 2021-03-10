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
    <nav class="navtop">
    	<div>
    		<h1>Sistema de Gereciamento de Clientes   </h1>
            <a href="$URL_BASE/index.php"><i class="fas fa-home"></i>Página Principal</a>
    		<a href="$URL_BASE/view/clientes/read.php"><i class="fas fa-address-book"></i>Clientes</a>
    		<a href="$URL_BASE/view/funcionarios/funcionarios.php"><i class="fas fa-address-book"></i>Funcionários</a>
    		<a id="myAnchor" href="#" onclick=adicionarItem();><i class="fas fa-address-book"></i>senhas</a>
    	</div>
    </nav>
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
			$('#myAnchor').attr('href', 'index.php')
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

</script>