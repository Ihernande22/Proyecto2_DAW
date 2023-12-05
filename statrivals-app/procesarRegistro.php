<?php
    session_start();
    //Comprueba si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['registrar'])) {
            //Guarda los datos del formulario
            $correo = $_POST['correoElectronico'];
            $nUsuario = $_POST['nombreUsuario'];
            $password = $_POST['password'];

            $validacionCorreo = true;
            $validacionUsuario = true;
            $validacionPassword = true;
            
            //Validacion correo
            if (empty($correo)) {
                $validacionCorreo = false;
                $_SESSION['errorCorreoElectronicoRegistro'] = "El correo eléctronico no puede estar vacio.";
                header("location:registrar.php");
            }
        }
    }
    echo "<a href='registrar.php'>Volver</a>";
?>