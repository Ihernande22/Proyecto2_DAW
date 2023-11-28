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



    if(isset($_POST['Insertar'])){
          //Validacion
     if(isset($_POST['correo']) && isset($_POST['UsuarioNuevo']) && $_POST['ContraseñaNuevoUsuario']){
        $correo = $_POST['correo'];
        $usuario = $_POST['UsuarioNuevo'];
        $contraseña  = $_POST['ContraseñaNuevoUsuario'];
        $regexContraseña = '/(?=(.*[0-9]))(?=.*[!@#$%^&*()\\[\]{}\-_+=|:;"\'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/';

        $validacion = true;
        

        if(empty($correo)){
           echo "El campo correo esta vacio";
           $validacion = false;
           
        }
        if(empty($usuario)) {
            echo "El campo de usuario está vacío <br>";
            $validacion = false;
        } elseif(strlen($usuario) < 6){
            echo "El campo de usuario tiene menos de 6 caracteres <br>";
            $validacion = false;
        }
        if(empty($contraseña)){
            echo "El campo contraseña esta vacio <br>";
            $validacion = false;
        } elseif(strlen($contraseña) <6){

            echo "El campo contraseña tiene menos de 6 caracteres";
            $validacion = false;

        }
        if($validacion == true){
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
                header('Location: codigo_Verificacion.php');
                exit;
         
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        }

    }
    else{ ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea el usuario</title>
</head>
<body>
    <h1>Crea el usuario</h1>

    <form method="post">
        <label>Correo Electronico:</label>
        <input type ="email" name="correo"><br><br>

        <label>Usuario:</label>
        <input type="text" name="UsuarioNuevo"><br><br>

        <label>Contraseña:</label>
        <input type="password" name="ContraseñaNuevoUsuario"><br><br>

        <button type="submit" name="Insertar">Insertar</button>

    </form>
  
    
</body>
</html>

   <?php     
        }


   

?>
