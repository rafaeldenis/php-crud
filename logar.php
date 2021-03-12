<?php


include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
//print_r($_POST);
//exit();
if (isset($_POST['email'])) {

    $email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
// Recupera a senha, a criptografando em MD5
   $senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
   
     
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :first AND senha = :segundo");

    /* Now we add the wanted values to our query */
    $value1 = "rafagdf85@gmail.com";
    $value2 = "123";
    $query->execute([
    "first" => $email,
    "segundo" => $senha
    ]);

$usuario = $query->fetch(PDO::FETCH_ASSOC);



    if (!$usuario) {
        //echo "nao encontrou usuário";
        session_start();
        $URL_BASE = "http://$_SERVER[HTTP_HOST]";
        if($URL_BASE=="http://localhost"){
            $diretorioProjeto = "/php-crud";
            $URL_BASE = $URL_BASE.$diretorioProjeto;
        }

        $msg = "Por favor verifica Usuário e senha informados!";
        $_SESSION['permissao'] = "NAO";
        $_SESSION['msgErro'] = $msg;
        header('Location: '.$URL_BASE.'/login.php');
        //exit('Por favor verifica Usuário e senha informados!');
    }else{
        
                session_start();
                $usuarioLogado  = $usuario['email'];
            
                $_SESSION['permissao'] = "SIM";
                $_SESSION['usuarioLogado'] = $usuarioLogado;
                unset($_SESSION['msgErroExpirou']);

                header('Location: index.php');
    }
}

    
?>
