<?php


include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
print_r($_POST);
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

                header('Location: index.php');
    }

    exit();
    // Make sure the user confirms beore deletion
    if (isset($_POST['SENHA'])) {
        
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE senha = ?');
        $stmt->execute([$_POST['senha']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            //exit('Por favor verifica Usuário e senha informados!');
            header('Location: read.php');
        }else{
            header('Location: read.php');
        }
           /* if($deletou):
                $msg = 'O CLIENTE '.$cliente['nome'].' '.$cliente['id'].' foi deletado com Sucesso!';
                session_start();
            
                $_SESSION['msgSucesso'] = $msg;
            else:
                $msg = 'O CLieNTE '.$cliente['nome'].' '.$cliente['id'].'não foi deletado , pois ocorrreu um erro inesperado';
                session_start();
            
                $_SESSION['msgErro'] = $msg;    
            endif;    
             header('Location: read.php');*/


     
    }else {
        exit('Por favor verifica Usuário e senha informados kkkkkkk!');
    }
} else {
    exit('Por favor verifica Usuário e senha informados kkk!');
}
?>
