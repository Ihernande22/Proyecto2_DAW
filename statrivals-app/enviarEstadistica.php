<?php

// Conexión a la base de datos
include "conexion.php";

if (!isset($_POST['ID_Jugador']) && !isset($_POST['Modo_De_Juego'])) {
    die("No se han proporcionado los datos necesarios.");
}

$id = $_POST['ID_Jugador']; 
$modo = $_POST['Modo_De_Juego']; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($modo == "goles") {
    $stmt = $conex->prepare("SELECT Goles FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
   
} elseif($modo ==  "asistencias") {
    $stmt = $conex->prepare("SELECT Asistencias from Jugador where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
} elseif($modo == "partidos") {
    $stmt = $conex->prepare("SELECT Partidos_Jugados FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
} elseif($modo == "valor") {
    $stmt = $conex->prepare("SELECT Valor FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
}


$stmt->execute();


$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  
    if ($modo == "goles") {
        echo "Goles: " . $row['Goles'] . "<br>";
    } elseif($modo ==  "asistencias") {
        echo "Asistencias: " . $row['Asistencias'] . "<br>";
    } elseif($modo == "partidos") {
        echo "Partidos Jugados: " . $row['Partidos_Jugados'] . "<br>";
    } elseif($modo == "valor") {
        echo "Valor De Mercado: " . $row['Valor'] . "<br>";
    }
}

$stmt->close();
$conex->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
