<?php
include "conexion.php";
include "Jugador.php";

session_start();

function recogerDatos($modo, $liga, $dificultad) {
    $validacionModo = FALSE;
    $validacionLiga = FALSE;
    $validacionDificultad = FALSE;

    if ($modo === "goles" || $modo === "asistencias" || 
    $modo === "valor" || $modo === "partidos") {
        $validacionModo = TRUE;
    }

    if ($liga === "premier" || $liga === "laliga" || 
    $liga === "bundesliga" || $liga === "serieA" ||
    $liga === "aleatorio") {
        $validacionLiga = TRUE;
    }

    if ($dificultad === "normal" || $dificultad === "dificil") {
        $validacionDificultad = TRUE;
    }

    if ($validacionModo === TRUE && $validacionLiga === TRUE &&
    $validacionDificultad === TRUE) {
        return [$modo, $liga, $dificultad];
    }
    else {
        return -1;
    }
}

function crearPartida($liga, $dificultad) {
    global $conex;

    // Comprueba si el usuario está logeado.
    if ($_SESSION['logeado'] === TRUE) {
        // Comprobar si el usuario está en partida
        if (comprobarEnPartida($_SESSION['usuario'])) {
            // El usuario ya está en partida, devolver -1
            return -1;
        } else {
            $id_usuario = obtenerIdUsuario($_SESSION['usuario']);

            // Actualiza o inserta el registro en la tabla Estado.
            actualizarEstadoUsuario($id_usuario, true);  // Puedes ajustar el valor de EnPartida según sea necesario
        }
    }

    // Transformar Liga en ID
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

    // Sacar array de jugadores a partir de la configuración seleccionada por el usuario.
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

// Funcion para crear una array de jugadores
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

// Comprueba si un usuario está en partida
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StatRivals</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/Jugador.js" defer></script>
    <script src="js/game.js" defer></script>
</head>
<body>
    <?php  
        $datos = recogerDatos($_POST['modo'], $_POST['liga'], $_POST['dificultad']);
        if ($datos === -1) {
            echo "<p class='datosIncorrectos'>No has configurado ninguna partida, la puedes configurar <a href='index.php'>aquí</a>.</p>";
        }
        else {
            // JUGAR
            $modo = $datos[0];
            $liga = $datos[1];
            $dificultad = $datos[2];
            // Array de jugadores
            $jugadores = crearPartida($liga, $dificultad);

            ?>
            <script>
            var jugadores = <?php echo json_encode($jugadores); ?>;
            </script>
            <?php
        }
    ?>
</body>
</html>
