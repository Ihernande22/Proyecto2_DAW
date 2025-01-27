<?php


header('Content-Type: text/html; charset=utf-8');

include "conexion.php";

session_start();

$puntuacion = $_POST['puntuacion'];
$listaJugadores = json_decode($_POST['listaJugadoresJson'], true);
//$listaJugadores = $_POST['listaJugadores'];
//$listaJugadores = json_decode($_POST['listaJugadoresJson'], true);
//$listaJugadoresJson = json_encode($listaJugadores);



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

function actualizarEstadoUsuario($idUsuario,$puntuacion,$listaJugadoresJson, $modo) {
    global $conex;

    // Comprueba si el usuario ya tiene un registro en la tabla Estado.
    $consulta_estado = "SELECT * FROM Estado_Partida WHERE ID_Usuario = $idUsuario";
    $resultado_estado = $conex->query($consulta_estado);

    $listaJugadoresJson = json_encode($listaJugadoresJson);

    if ($resultado_estado->num_rows > 0) {
        // Si el usuario ya tiene un registro, actualiza Puntuacion y Lista_Jugadores según los valores proporcionados.
        $update_estado = "UPDATE Estado_Partida SET Puntuacion = $puntuacion, Lista_Jugadores = '$listaJugadoresJson', Modo = '$modo' WHERE ID_Usuario = $idUsuario";
        $conex->query($update_estado);
    } else {
       // Si no existe un registro, crea uno con Puntuacion y Lista_Jugadores según los valores proporcionados.
    $insert_estado = "INSERT INTO Estado_Partida (ID_Usuario, Puntuacion, Lista_Jugadores, Modo) VALUES ($idUsuario, $puntuacion, '$listaJugadoresJson', '$modo')";
    $conex->query($insert_estado);
    }

}

    $usuario = obtenerIdUsuario($_SESSION['usuario']);
    //echo "TU puntuacion es $puntuacion y tu lista de jugadores es $listaJugadores";
    
    
    actualizarEstadoUsuario($usuario, $puntuacion,$listaJugadores, $_SESSION['modo']);
 


?>