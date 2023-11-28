<?php

            include('conexion.php');
            include ('crea_usuario.php');
            echo $codigo;
            if(isset($_POST['Enviar'])){

                $codigoVerificiacion = $_POST['codigoVerificacion'];
                $hash = password_hash($contrasena, PASSWORD_DEFAULT);
                $consulta = "INSERT INTO Usuario( Nombre_Usuario ,  Correo_Electronico , Contraseña) VALUES ('$usuario','$correo','$hash')";
                $resultado = mysqli_query($conex,$consulta);

               
            }
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="post">
     <label>Pon tu codigo de verificacion nano</label>
     <input type="text" name="codigoVerificacion"><br><br>
     <input type="submit" name="Enviar">
    </form>
</body>
</html>
