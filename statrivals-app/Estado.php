<?php

include "conexion.php";

session_start();
//$_SESSION['usuario'];
$enPartida = $_POST['enPartida'];




// Funcion para obtener el ID de un usuario con el nombre de usuario
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

function actualizarEstadoUsuario($idUsuario, $enPartida) {
global $conex;

// Comprueba si el usuario ya tiene un registro en la tabla Estado.
$consulta_estado = "SELECT * FROM Estado WHERE ID_Usuario = $idUsuario";
$resultado_estado = $conex->query($consulta_estado);

if ($resultado_estado->num_rows > 0) {
// Si el usuario ya tiene un registro, actualiza EnPartida según el valor proporcionado.
$update_estado = "UPDATE Estado SET EnPartida = " . ($enPartida ? 'TRUE' : 'FALSE') . " WHERE ID_Usuario = $idUsuario";
$conex->query($update_estado);
echo "hola";
} else {
// Si no existe un registro, crea uno con EnPartida según el valor proporcionado.
$insert_estado = "INSERT INTO Estado (ID_Usuario, EnPartida) VALUES ($idUsuario, " . ($enPartida ? 'TRUE' : 'FALSE') . ")";
$conex->query($insert_estado);
}

}

$usuario = obtenerIdUsuario($_SESSION['usuario']);
echo "Cambio de estado del usuario $usuario a $enPartida";
actualizarEstadoUsuario($usuario, $enPartida);
?>