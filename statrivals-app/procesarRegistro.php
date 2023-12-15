<?php
    session_start();
    $_SESSION['logeado'] = FALSE;
    include "VerifyEmail.php";
    include "conexion.php";
    function validarCorreoElectronico($correo) {
        // Expresión regular para validar el formato del correo electrónico
        $patron = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    
        // Verificar si el correo electrónico coincide con el patrón
        if (preg_match($patron, $correo)) {
            return -1; // El correo electrónico es válido
        } else {
            // El correo electrónico no es válido, proporcionar mensajes de error específicos
    
            // Verificar si el campo contiene un símbolo "@"
            if (strpos($correo, '@') === false) {
                return "El correo electrónico debe contener un símbolo '@'.";
            }
    
            // Verificar si hay al menos un carácter antes y después del "@"
            $partes = explode('@', $correo);
            if (count($partes) !== 2 || empty($partes[0]) || empty($partes[1])) {
                return "En el correo debe haber al menos un carácter antes y después del símbolo '@'.";
            }
    
            // Verificar si hay un punto (.) después del "@" y al menos un carácter después del punto
            if (strpos($partes[1], '.') === false || empty(substr(strstr($partes[1], '.'), 1))) {
                return "En el correo después del símbolo '@' debe haber un punto (.) y al menos un carácter después del punto.";
            }
    
            // Verificar si hay espacios en blanco al principio o al final del correo electrónico
            if (trim($correo) !== $correo) {
                return "El correo electrónico no debe contener espacios en blanco al principio o al final.";
            }
    
            // Verificar si el correo electrónico contiene caracteres especiales
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                return "El correo electrónico contiene caracteres no permitidos.";
            }
    
            // Devolver -1 si no hay errores
            return -1;
        }
    }
    
    function validarNombreUsuario($nombreUsuario, $conex) {
        // Realizar validaciones del nombre de usuario
        // 1. Longitud del nombre de usuario (por ejemplo, entre 4 y 20 caracteres)
        if (strlen($nombreUsuario) < 4 || strlen($nombreUsuario) > 20) {
            return "La longitud del nombre de usuario debe estar entre 4 y 20 caracteres.";
        }

        // 2. Caracteres permitidos (letras, números, guiones bajos, etc.)
        $patron = '/^[a-zA-Z0-9_]+$/';

        if (!preg_match($patron, $nombreUsuario)) {
            return "El nombre de usuario solo puede contener letras, números y guiones bajos.";
        }
        
        // 3. Disponibilidad del nombre de usuario (verificar en la base de datos)
        $query = "select count(*) as contador from Usuario where Nombre_Usuario like '$nombreUsuario';";
        if ($resultado = $conex->query($query)) {
            while ($fila = $resultado->fetch_assoc()) {
                if ($fila['contador'] > 0) {
                    return "El nombre de usuario ya ha sido elegido por otro usuario.";
                }
            }
        }

        // Devolver -1 si no hay errores
        return -1;
    }

    function validarContrasena($contrasena) {
        // 1. Longitud de la contraseña (entre 6 y 20 caracteres)
        if (strlen($contrasena) < 6 || strlen($contrasena) > 20) {
            return "La longitud de la contraseña debe estar entre 6 y 20 caracteres.";
        }
    
        // 2. Caracteres permitidos (pueden incluir letras, números y algunos caracteres especiales)
        $patron = '/^[a-zA-Z0-9!"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]+$/';
    
        if (!preg_match($patron, $contrasena)) {
            return "La contraseña solo puede contener letras, números y los siguientes caracteres especiales: ! \" # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \\ ] ^ _` { | } ~";
        }
    
        // 3. Requisitos adicionales según las políticas de seguridad (mayúsculas, minúsculas, números, caracteres especiales, etc.)
        // Verificar si la contraseña contiene al menos una letra minúscula
        if (!preg_match('/[a-z]/', $contrasena)) {
            return "La contraseña debe contener al menos una letra minúscula.";
        }
    
        // Verificar si la contraseña contiene al menos una letra mayúscula
        if (!preg_match('/[A-Z]/', $contrasena)) {
            return "La contraseña debe contener al menos una letra mayúscula.";
        }
    
        // Verificar si la contraseña contiene al menos un número
        if (!preg_match('/[0-9]/', $contrasena)) {
            return "La contraseña debe contener al menos un número.";
        }
    
        // Verificar si la contraseña contiene al menos un caracter especial
        if (!preg_match('/[!\"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]/', $contrasena)) {
            return "La contraseña debe contener al menos un caracter especial: ! \" # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \\ ] ^ _` { | } ~";
        }
    
        // Devolver -1 si no hay errores
        return -1;
    }
    

    //Comprueba si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['registrar'])) {
            //Guarda los datos del formulario
            $correo = $_POST['correoElectronico'];
            $nUsuario = $_POST['nombreUsuario'];
            $password = $_POST['password'];
            

            //Validacion correo
            $validacionCorreo = validarCorreoElectronico($correo);
            if ($validacionCorreo == -1) {
                //Verificacion de que el correo exista(falta)
                $correoExiste = verificarCorreoElectronicoExistente($correo);
                if ($correoExiste == -1) {
                    //Verificación de que el correo no este repetido en la BBDD
                    $query = "select count(*) as contador from Usuario where Correo_Electronico like '$correo';";
                    if ($resultado = $conex->query($query)) {
                        while ($fila = $resultado->fetch_assoc()) {
                            if ($fila['contador'] > 0) {
                                $_SESSION['mensajeError'] = "El correo introducido ya ha sido elegido por otro usuario.";
                                header("location:registrar.php");
                                exit;
                            }
                        }
                    }
                }
                else {
                    $_SESSION['mensajeError'] = "El correo introducido no existe.";
                    header("location:registrar.php");
                    exit;
                }
            } 
            else {
                //No ha pasado la verificació, devuelve el mensaje de error
                $_SESSION['mensajeError'] = $validacionCorreo;
                header("location:registrar.php");
                exit;
            }

            // Validacion nombre de usuario
            $validacionUsuario = validarNombreUsuario($nUsuario, $conex);
            if ($validacionUsuario != -1) {
                // Ha habido un error en la validación del nombre de usuario
                $_SESSION['mensajeError'] = $validacionUsuario;
                header("location:registrar.php");
                exit;
            }

            // Validacion contraseña
            $validacionContrasena = validarContrasena($password);
            if ($validacionContrasena != -1) {
                // Ha habido un error en la validación de la contraseña
                $_SESSION['mensajeError'] = $validacionContrasena;
                header("location:registrar.php");         
                exit;
            }

            // Generar la contraseña cifrada
            $contrasenaCifrada = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el usuario en la base de datos con la contraseña cifrada
            $queryInsert = "INSERT INTO Usuario (Correo_Electronico, Nombre_Usuario, Contraseña) VALUES ('$correo', '$nUsuario', '$contrasenaCifrada');";
            if ($conex->query($queryInsert)===TRUE) {
                echo "<div class='registroCorrecto'><p>Se ha registrado el usuario correctamente.</p><a href='index.php'>Volver</a></div>";
                $_SESSION['logeado'] = TRUE;
                $_SESSION['usuario'] = $nUsuario;
            } else {
                $_SESSION['mensajeError'] = "Error al registrar el usuario en la base de datos.";
                //header("location:registrar.php");
                exit;
            }
        }
    }
?>