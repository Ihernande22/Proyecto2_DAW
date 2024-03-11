<?php

    include "conexion.php";
    session_start();

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

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];
        //COMPRUEBA QUE LAS CONTRASEÑAS SON IGUALES
        if ($password != $passwordRepeat) {
            $_SESSION['mensajeError'] = "Las contraseñas no coinciden.";
        }
        else {
            // Validacion contraseña
            $validacionContrasena = validarContrasena($password);
            if ($validacionContrasena != -1) {
                // Ha habido un error en la validación de la contraseña
                $_SESSION['mensajeError'] = $validacionContrasena;
            }
            else {
                //ACTUALIZA LA TABLA Y LOGEA AL USUARIO
                $contraseña = password_hash($password, PASSWORD_DEFAULT);
                $correo = $_SESSION['correoRecuperacion'];

                $sql = "UPDATE Usuario SET Contraseña = ? WHERE Correo_Electronico = ?";

                $stmt = $conex->prepare($sql);


                
                $stmt->bind_param('ss', $contraseña, $correo);

                if ($stmt->execute() === true) {
                    $_SESSION['logeado'] = TRUE;
                    $query = "SELECT Nombre_Usuario from Usuario where Correo_Electronico like '$correo';";
                    $consulta = $conex->query($query);
                    while ($row = $consulta->fetch_assoc()) {
                        $nUsuario = $row['Nombre_Usuario'];
                    }
                    $_SESSION['usuario'] = $nUsuario;
                } 

            
                $stmt->close();
            }
        }
        header("location:passwordOlvidada.php");
    }

?>