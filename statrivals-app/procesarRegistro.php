<?php
    session_start();
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
                return "Debe haber al menos un carácter antes y después del símbolo '@'.";
            }
    
            // Verificar si hay un punto (.) después del "@" y al menos un carácter después del punto
            if (strpos($partes[1], '.') === false || empty(substr(strstr($partes[1], '.'), 1))) {
                return "Después del símbolo '@' debe haber un punto (.) y al menos un carácter después del punto.";
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
                    $query = "select count(*) as contador from Usuario where Correo_Electronico like $correo;";
                    if ($resultado = $conex->query($query)) {
                        while ($fila = $resultado->fetch_assoc()) {
                            $_SESSION['mensajeError'] = "Contador: ". $fila['contador'];
                            header("location:registrar.php");
                        }
                    }
                }
                else {
                    $_SESSION['mensajeError'] = "El correo introducido no existe.";
                    header("location:registrar.php");
                }
            } 
            else {
                //No ha pasado la verificació, devuelve el mensaje de error
                $_SESSION['mensajeError'] = $validacionCorreo;
                header("location:registrar.php");
            }
        }
    }
    echo "<a href='registrar.php'>Volver</a>";
?>