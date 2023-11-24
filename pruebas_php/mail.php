<?php
  include('conexion.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/Exception.php';

  require 'phpmailer/SMTP.php';


  require 'phpmailer/PHPMailer.php';

  function generarCodigoVerificacion($longitud = 6) {
    $caracteres = '0123456789'; // Puedes ajustar los caracteres según tus necesidades
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}

// Ejemplo de uso
$codigo = generarCodigoVerificacion();
echo "Código de verificación: " . $codigo;


  if(isset($_POST['Insertar'])){

    

  
  if(strlen($_POST['correo']) >0 && strlen($_POST['UsuarioNuevo']) >0 && strlen($_POST['ContraseñaNuevoUsuario']) >0){
    $correo = $_POST['correo'];
    $nombre = $_POST['UsuarioNuevo'];
    $contraseña = $_POST['ContraseñaNuevoUsuario'];
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    
    $consulta = "INSERT INTO Usuario( Nombre_Usuario ,  Correo_Electronico , Contraseña) VALUES ('$nombre','$correo','$hash')";
    $resultado = mysqli_query($conex,$consulta);

    $mail = new PHPMailer(true);

try {
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
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    if($resultado){
      ?>
      <h3>Te has inscrito correctamente </h3>
      <?php
    }else{
      ?>

      <h3>Error </h3>




      <?php
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validacion</title>
</head>
<body>
   
      <h1>Prueba<h1>
</body>
</html>
