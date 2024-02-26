<?php

// Conexión a la base de datos
include "conexion.php";

session_start();

function obtenerIdUsuario($nombreUsuario) {
    global $conex;

    $id_usuario = 0;

    // Obtén el ID del usuario basado en el nombre de usuario.
    $consulta_id_usuario = "SELECT ID_Usuario FROM Usuario WHERE Nombre_Usuario LIKE '$nombreUsuario';";
    
    if ($resultado_id_usuario = $conex->query($consulta_id_usuario)) {
        while ($fila_id_usuario = $resultado_id_usuario->fetch_assoc()) {
            $id_usuario = $fila_id_usuario['ID_Usuario'];
        }
    }

    return $id_usuario;
}

$usuario = obtenerIdUsuario($_SESSION['usuario']);
$consulta = $conex->query("SELECT EnPartida FROM Estado Where ID_Usuario = $usuario");

while ($row = $consulta->fetch_assoc()) {
    echo $row['EnPartida'];
}

?>
