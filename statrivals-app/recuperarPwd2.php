<?php 

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_SESSION['correoRecuperacion'];
    $codigo = rand(100000, 999999); // Genera un código de verificación aleatorio

    $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ihernande1@inscamidemar.cat';                     //SMTP username
        $mail->Password   = '613aef2d26785';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ihernande1@inscamidemar.cat', 'StatRivals');
        $mail->addAddress( $correo, 'Joe User');     //Add a recipient            //Name is optional

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Tu codigo de verificacion';
        $mail->Body    = 'Tu codigo de verificacion es '.$codigo;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION['codigoEnviado'] = TRUE;
        $_SESSION['codigoVerificacion'] = $codigo;
        header("location:passwordOlvidada.php");
}

?>