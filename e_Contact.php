<?php

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$endereco = $_POST['endereco'];
$message = $_POST['message'];

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.umbler.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contato@xxxxx.com.br';
    $mail->Password = '*';
    $mail->Port = '587';

    $mail->setFrom('contato@xxxxx.com.br');
    $mail->addAddress('contato@xxxxx.com.br');

    $mail->isSMTP();
    $mail->Subject = 'Mensagem Recebida - Site';

    
    $mail->CharSet = 'UTF-8';
    $mail->Body .= "Nome: " . $name . " <br>"; 
    $mail->Body .= "Email: " . $email . " <br>";
    $mail->Body .= "Telefone: " . $phone . " <br>";
    $mail->Body .= "Endereço: " . $endereco . " <br>";
    $mail->Body .= "Mensagem: " . $message . " <br>";
    

    $mail->AltBody = "Para conseguir essa e-mail corretamente, use um visualizador de e-mail com suporte a HTML";

    if ($mail->send()):
        // Enviada com sucesso
        header('location:Index.php?mail=sucesso');
      else:
        // Se der erro
        header('location:Index.php?mail=erro');
      endif;

} catch (Exception $e) {
    echo 'Erro ao enviar mensagem: {$mail->ErrorInfo}';
}

?>