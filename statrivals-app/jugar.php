<?php

include "conexion.php";
include "Jugador.php";
session_start();


function crearPartida($liga, $dificultad) {
    global $conex;

    //Transformar Liga en ID
    switch($liga) {
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
    // Comprueba si el usuario está logeado.
    if ($_SESSION['logeado'] === TRUE) {
        $id_usuario = obtenerIdUsuario($_SESSION['usuario']);

        // Actualiza o inserta el registro en la tabla Estado.
        actualizarEstadoUsuario($id_usuario, true);  // Puedes ajustar el valor de EnPartida según sea necesario
    }

    //Sacar array de jugadores a partir de la configuracion seleccionada por el usuario.
    $jugadores = crearArrayJugadores($IDliga, $dificultad);

    return $jugadores;
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

// Funcion que modifica o crea la tabla estado de un usuario
function actualizarEstadoUsuario($idUsuario, $enPartida) {
    global $conex;

    // Comprueba si el usuario ya tiene un registro en la tabla Estado.
    $consulta_estado = "SELECT * FROM Estado WHERE ID_Usuario = $idUsuario";
    $resultado_estado = $conex->query($consulta_estado);

    if ($resultado_estado->num_rows > 0) {
        // Si el usuario ya tiene un registro, actualiza EnPartida según el valor proporcionado.
        $update_estado = "UPDATE Estado SET EnPartida = " . ($enPartida ? 'TRUE' : 'FALSE') . " WHERE ID_Usuario = $idUsuario";
        $conex->query($update_estado);
    } else {
        // Si no existe un registro, crea uno con EnPartida según el valor proporcionado.
        $insert_estado = "INSERT INTO Estado (ID_Usuario, EnPartida) VALUES ($idUsuario, " . ($enPartida ? 'TRUE' : 'FALSE') . ")";
        $conex->query($insert_estado);
    }
}

//Funcion para crear una array de jugadores
function crearArrayJugadores($IDliga, $dificultad) {
    global $conex;
    $arrayJugadores = [];

    // Construir la consulta SQL
    if ($IDliga !== "aleatorio") {
        $query = "SELECT * FROM Jugador WHERE ID_Liga = $IDliga AND Popularidad ";
    } else {
        $query = "SELECT * FROM Jugador WHERE Popularidad ";
    }

    // Añadir la condición de dificultad a la consulta
    if ($dificultad === "normal") {
        $query .= "LIKE '%alta%'";
    } elseif ($dificultad === "dificil") {
        $query .= "LIKE '%media%'";
    }
    $query .= ";";


    // Ejecutar la consulta
    $result = $conex->query($query);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Recorrer los resultados y crear objetos Jugador
        while ($row = $result->fetch_assoc()) {
            $jugador = new Jugador(
                $row['ID_Jugador'],
                $row['Nombre_Jugador'],
                $row['Goles'],
                $row['Asistencias'],
                $row['Valor'],
                $row['Partidos_Jugados'],
                $row['Popularidad'],
                $row['Imagen']
            );

            // Agregar el objeto Jugador al array
            $arrayJugadores[] = $jugador;
        }

        // Ordenar el array de forma aleatoria
        shuffle($arrayJugadores);
    } else {
        echo "No se encontraron jugadores.";
    }

    return $arrayJugadores;
}


// Función para cargar la partida (de la BBDD, similar a crearPartida)
function cargarPartida($liga, $dificultad) {
    global $conex;

    // Transformar Liga en ID
    switch ($liga) {
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

    // Comprueba si el usuario está logeado.
    if ($_SESSION['logeado'] === TRUE) {
        $id_usuario = obtenerIdUsuario($_SESSION['usuario']);

        // Consulta para verificar si hay algo en la tabla estado_partida
        $consulta_estado_partida = "SELECT * FROM estado_partida WHERE ID_Usuario = $id_usuario";
        $resultado_estado_partida = $conex->query($consulta_estado_partida);

        if ($resultado_estado_partida->num_rows > 0) {
            // Si hay algo en la tabla estado_partida, muestra un comentario
            echo "La partida está en progreso. Puedes continuar desde aquí.";
        } else {
            // Si no hay nada, crea una nueva partida y muestra la lista de jugadores
            $jugadores = crearArrayJugadores($IDliga, $dificultad);
            return $jugadores;
        }
    }
}



// Función con la lógica del juego
function jugarPartida($listaJugadores, $modo, $liga, $dificultad) {
    global $conex;

    // Transformar Liga en ID
    switch ($liga) {
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

    // Transformar Modo en ID
    switch ($modo) {
        case "goles":
            $IDmodo = 1;
            break;
        case "asistencias":
            $IDmodo = 2;
            break;
        case "partidos":
            $IDmodo = 3;
            break;
        case "valor":
            $IDmodo = 4;
            break;
        default:
            $IDmodo = 0;
    }

    $puntuacion = 0;

}



//Comprueba si un usuario esta en partida
function comprobarEnPartida($nombreUsuario) {
    global $conex;

    // Obtener el ID del usuario
    $idUsuario = obtenerIdUsuario($nombreUsuario);

    // Consultar el estado del usuario
    $consultaEstado = "SELECT EnPartida FROM Estado WHERE ID_Usuario = $idUsuario";
    $resultadoEstado = $conex->query($consultaEstado);

    if ($resultadoEstado->num_rows > 0) {
        $filaEstado = $resultadoEstado->fetch_assoc();
        return $filaEstado['EnPartida'] === '1'; // Retorna true si EnPartida es 1, false si es 0
    }

    return false; // Por defecto, el usuario no está en partida
}



//funcion para jugar una partida
function jugar($liga, $modo, $dificultad) {
    //Comprueba si el usuario esta logeado
    if(isset($_SESSION['logeado']) && $_SESSION['logeado'] === TRUE) {
        echo "Usuario: ".$_SESSION['usuario']."<br>";
        // Comprobar si el usuario está en partida
        if (comprobarEnPartida($_SESSION['usuario'])) {
            // El usuario está en partida
            // cargarPartida();  
            $jugadores = cargarPartida($liga, $dificultad);
        } 
        
        else {
            // El usuario no está en partida
            // Crea una nueva partida y juega
            $jugadores = crearPartida($liga, $dificultad);
        }

        //Jugar
        jugarPartida($jugadores, $modo, $dificultad);

    }
    else {
        echo "Invitado";
    }
}


echo jugar("laliga", "asistencias", "normal");
?>
