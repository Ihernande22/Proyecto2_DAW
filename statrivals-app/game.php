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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StatRivals</title>
    <link rel="stylesheet" href="css/game.css">
    <link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/Jugador.js" defer></script>
    <script src="js/game.js" defer></script>
</head>
<body>
    <?php  
        $datos = recogerDatos($_POST['modo'], $_POST['liga'], $_POST['dificultad']);
        if ($datos != -1) { // Verificar si se ha enviado el formulario
            // Guardar los datos del formulario en variables de sesión
            $_SESSION['modo'] = $_POST['modo'];
            $_SESSION['liga'] = $_POST['liga'];
            $_SESSION['dificultad'] = $_POST['dificultad'];
        } 
        if (isset($_SESSION['modo'], $_SESSION['liga'], $_SESSION['dificultad'])) {
                // Utilizar los datos almacenados en las variables de sesión
                $modo = $_SESSION['modo'];
                $liga = $_SESSION['liga'];
                $dificultad = $_SESSION['dificultad'];
                // Array de jugadores
                $jugadores = crearPartida($liga, $dificultad);


                ?>
                <script>
                <?php /*var jugadores = <?php echo json_encode(array_map(function($jugador) {
                    return array(
                        'id' => $jugador->getID(),
                        'nombre' => $jugador->getNombre(),
                        'imagen' => $jugador->getImagen()
                    );
                }, $jugadores)); ?>;*/?>
                var jugadores = <?php echo json_encode($jugadores); ?>;
                var estadistica = <?php echo json_encode($modo)?>
                </script>

            <?php
        } 
        
    ?>
</body>
</html>
