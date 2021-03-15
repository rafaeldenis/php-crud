Exemplo Gmail
    <?php

    // Caminho da biblioteca PHPMailer

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/POP3.php';
require 'phpmailer/SMTP.php';
 
// Instância do objeto PHPMailer
$mail = new PHPMailer();
 
// Configura para envio de e-mails usando SMTP
$mail->isSMTP();
 
// Servidor SMTP
$mail->Host = 'smtp.gmail.com';
 
// Usar autenticação SMTP
$mail->SMTPAuth = true;
 


$empresa = $_POST["empresa"];
$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$mensagem = $_POST["mensagem"];

$texto = "
<h3>Formulário</h3><br>
<b>Empresa:</b> $empresa<br>
<b>Nome do Cliente:</b> $nome<br> 
<b>Telefone:</b> $telefone<br>
<b>E-mail:</b> $email
<b>Mensagem:</b> $mensagem
";
// Usuário da conta
$mail->Username = 'rafagdf85@gmail.com'; 
// Senha da conta
$mail->Password = '101947davi';
 
// Tipo de encriptação que será usado na conexão SMTP
$mail->SMTPSecure = 'ssl'; 
 
// Porta do servidor SMTP
$mail->Port = 465;
 
// Informa se vamos enviar mensagens usando HTML
$mail->IsHTML(true);
 
// Email do Remetente
$mail->From = 'rafael.denis@unifesp.br';
 
// Nome do Remetente
$mail->FromName = 'Rafael';
 
// Endereço do e-mail do destinatário
$mail->addAddress('rafael.denis@unifesp.br');
 
// Assunto do e-mail
$mail->Subject = 'E-mail PHPMailer';
 
// Mensagem que vai no corpo do e-mail
$mail->Body = $texto;
 
// Envia o e-mail e captura o sucesso ou erro
if($mail->Send()):
    session_start();
    $URL_BASE = "http://$_SERVER[HTTP_HOST]";
    if($URL_BASE=="http://localhost"){
        $diretorioProjeto = "/php-crud";
        $URL_BASE = $URL_BASE.$diretorioProjeto;
    }

    $msg = 'email enviado com sucesso';
    
    $_SESSION['msgSucesso'] = $msg;

    header('Location: index.php');
    
    exit();

else:
    echo 'Erro ao enviar Email:' . $mail->ErrorInfo;
endif;
    ?>
