<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigoVerificacion'])) {
    if ($_POST['codigoVerificacion'] == $_SESSION['codigoVerificacion']) {
        $_SESSION['codigoValidado'] = TRUE;
    }
    else {
        $_SESSION['mensajeError'] = "El codigo introducido es incorrecto.";
    }
    header("location:passwordOlvidada.php");
}

?>