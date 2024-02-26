<?php

include "conexion.php";

session_start();
//$_SESSION['usuario'];
$puntuacion= $_POST['puntuacion'];


$id_modo = $_SESSION['modo'];
$IDliga = $_SESSION['liga'];
$dificultad = $_SESSION['dificultad'];

$fecha_actual = date("Y-m-d H:i:s");


// Transformar Liga en ID
    switch($IDliga) {
        case "laliga":
            $IDliga = 1;
            break;
        case "premier":
            $IDliga = 2;
            break;
        case "bundesliga":
            $IDliga = 3;
            break;
        case "serieA":
            $IDliga = 4;
            break;
        case "aleatorio":
            $IDliga = "aleatorio";
            break;

    default:
        $IDliga = 0;
}


//Transformar modo en id

switch($id_modo ){

    case "goles":
        $id_modo = 1;
        break;
    case "asistencias":
        $id_modo = 2;
        break;
    case "valor":
        $id_modo = 3;
        break;
    case "partidos":
        $id_modo = 4;
        break;

default:
    $id_modo = 0;

}


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
    
function actualizarEstadoUsuario($idUsuario,$id_modo,$IDliga,$dificultad, $puntuacion,$fecha_actual) {
    global $conex;
    
    // Comprueba si el usuario ya tiene un registro en la tabla Estado.
    $consulta_registro = "SELECT * FROM Registro_Partida WHERE ID_Usuario = $idUsuario";
    $resultado_estado = $conex->query($consulta_registro);

    $insert_registro = "INSERT INTO Registro_Partida (ID_Usuario, ID_Modo, ID_Liga, Dificultad, Puntuacion, Fecha) VALUES ($idUsuario, $id_modo, $IDliga, '$dificultad', $puntuacion, '$fecha_actual')";

    $conex->query($insert_registro);
    
    
    }
    
    $usuario = obtenerIdUsuario($_SESSION['usuario']);

    
    
    actualizarEstadoUsuario($usuario,$id_modo,$IDliga,$dificultad, $puntuacion,$fecha_actual);

?>
