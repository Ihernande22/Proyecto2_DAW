<?php
include('configuracion.php');
    if(isset($_POST['correo']) && isset($_POST['UsuarioNuevo']) && isset($_POST['ContraseñaNuevoUsuario'])){
        $correo = $_POST['correo'];
        $UsuarioNuevo = $_POST['UsuarioNuevo'];
        $contraseña = $_POST['ContraseñaNuevoUsuario'];
        $regexContraseña = '/(?=(.*[0-9]))(?=.*[!@#$%^&*()\\[\]{}\-_+=|:;"\'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/';
    
        if(empty($correo)){
            echo "El campo correo está vacío <br>";
        } elseif(strlen($correo) < 6){
            echo "El campo correo tiene menos de 6 caracteres <br>";
        }

    
        if(empty($UsuarioNuevo)){
            echo "El campo usuario está vacío <br>";
        } elseif(strlen($UsuarioNuevo) < 6){
            echo "El campo usuario tiene menos de 6 caracteres <br>";
        }
    

        if(empty($contraseña)){
            echo "El campo contraseña está vacío <br>";

        }elseif(!preg_match($regexContraseña, $contraseña)){
            echo "La contraseña no cumple con los requisitos de seguridad <br>";
        }

  
        
        

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea el usuario</title>
</head>
<body>
    <h1>Crea el usuario</h1>

    <form method="post" action="mail.php">
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
