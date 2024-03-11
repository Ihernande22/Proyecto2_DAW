<?php

session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuarioRecuperacion'])) {
    $contador = 0;
    $usuario = $_POST['usuarioRecuperacion'];
    $query = "SELECT COUNT(*) as contador FROM Usuario where Nombre_Usuario like '$usuario';";
    $consulta = $conex->query($query);
    while ($row = $consulta->fetch_assoc()) {
        $contador = $row['contador'];
    }

    if ($contador == 1) {
        $query = "SELECT Correo_Electronico from Usuario where Nombre_Usuario like '$usuario';";
        $consulta = $conex->query($query);
        while ($row = $consulta->fetch_assoc()) {
            $_SESSION['correoRecuperacion'] = $row['Correo_Electronico'];
        }
    }
    else {
        $_SESSION['mensajeError'] = "No se ha encontrado el usuario introducido.";
    }
    header("location:passwordOlvidada.php");
}

?>