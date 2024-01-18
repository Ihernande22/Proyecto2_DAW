<?php
    session_start();
    include "conexion.php";
    function validarNombreUsuario($nUsuario, $conex) {
        // 1. Comprobar del nombre de usuario (verificar en la base de datos)
        $query = "select count(*) as contador from Usuario where Nombre_Usuario like '$nUsuario';";
        if ($resultado = $conex->query($query)) {
            while ($fila = $resultado->fetch_assoc()) {
                if ($fila['contador'] == 0) {
                    return "No se han encontrado usuarios con el nombre de usuario introducido.";
                }
            }
        }
            
        // Devolver -1 si no hay errores
        return -1;
    }
            
    function validarContrasena($contrasena, $nusuario, $conex) {
        // 1. Obtener la contraseña cifrada del usuario
        $query = "SELECT Contraseña FROM Usuario WHERE Nombre_Usuario LIKE '$nusuario';";
                    
        if ($resultado = $conex->query($query)) {
            while ($fila = $resultado->fetch_assoc()) {
                $contrasenaCifrada = $fila['Contraseña'];
            }
        }
        // 2. Comparar la contraseña
        if(password_verify($contrasena, $contrasenaCifrada) === TRUE){
            //Datos correctos
            return -1;
        }else{
            //Datos incorrectos
            return "La contraseña es incorrecta.";
        }
    }                        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StatRivals</title>
    <link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php 
        if ($_SESSION['logeado'] === TRUE) {
            echo "<div class='registroCorrecto'>";
            echo "<p class='logeadoYa'>Esta funcionalidad esta desactivada mientras la sesión esta iniciada</p>";
            echo "<a href='index.php'>Volver</a>";
            echo "</div>";
        }
        else {
                $_SESSION['logeado'] = FALSE;
                //Comprueba si se ha enviado el formulario
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['iniciar_sesion'])) {
                        //Guarda los datos del formulario
                        $nombreUsuario = $_POST['nombreUsuario'];
                        $password = $_POST['password'];
                        // Validacion nombre de usuario
                        $validacionUsuario = validarNombreUsuario($nombreUsuario, $conex);
                        if ($validacionUsuario != -1) {
                            // Ha habido un error en la validación del nombre de usuario
                            $_SESSION['mensajeError'] = $validacionUsuario;
                            header("location:login.php");
                            exit;
                        }
                
                        // Validacion contraseña
                        $validacionContrasena = validarContrasena($password, $nombreUsuario, $conex);
                        if ($validacionContrasena != -1) {
                            // Ha habido un error en la validación de la contraseña
                            $_SESSION['mensajeError'] = $validacionContrasena;
                            header("location:login.php");         
                            exit;
                        }
                        echo "<div class='registroCorrecto'><p>Se ha iniciado sesión correctamente.</p><a href='index.php'>Volver</a></div>";
                        $_SESSION['logeado'] = TRUE;
                        $_SESSION['usuario'] = $nombreUsuario;
                    }
                }
                else {
                    header("location:login.php");
                    exit;
                }
            }
    ?>