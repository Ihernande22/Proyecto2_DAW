<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['correo'])) {
    $correo = $_POST['correo'];
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
        echo 'Message has been sent';
        $_SESSION['correo_enviado'] = true;
        $_SESSION['codigo'] = $codigo;

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigo'])) {
    // Comprueba si el código introducido por el usuario coincide con el código almacenado en la sesión
    if ($_POST['codigo'] == $_SESSION['codigo']) {
        echo "El código es correcto.";
        $_SESSION['resetPassword'] = true; // Crea la variable de sesión resetPassword
    } else {
        echo "El código es incorrecto.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    // Aquí puedes agregar el código para cambiar la contraseña
}
?>

<?php if (isset($_SESSION['resetPassword']) && $_SESSION['resetPassword']): ?>
    <form method="post" action="">
        <label for="password">Nueva contraseña:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirmar nueva contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <input type="submit" value="Cambiar contraseña">
    </form>
<?php elseif (isset($_SESSION['correo_enviado']) && $_SESSION['correo_enviado']): ?>
    <form method="post" action="">
        <label for="codigo">Introduce el código de verificación:</label>
        <input type="text" id="codigo" name="codigo" required>
        <input type="submit" value="Verificar código">
    </form>
<?php else: ?>
    <form method="post" action="">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <input type="submit" value="Enviar código">
    </form>
<?php endif; ?>
