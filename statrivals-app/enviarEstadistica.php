<?php

// Conexión a la base de datos
include "conexion.php";

if (!isset($_POST['ID_Jugador']) || !isset($_POST['Nombre_Modo'])) {
    die("No se han proporcionado los datos necesarios.");
}

$id = $_POST['ID_Jugador']; 
$modo = $_POST['Nombre_Modo']; 

//echo $id;

// echo $modo;


if ($conex->connect_error) {
    die("Connection failed: " . $conex->connect_error);
}

if ($modo == "Goles") {
    $stmt = $conex->prepare("SELECT Goles FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
   
} elseif($modo ==  "Asistencias") {
    $stmt = $conex->prepare("SELECT Asistencias from Jugador where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
} elseif($modo == "Partidos") {
    $stmt = $conex->prepare("SELECT Partidos_Jugados FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
} elseif($modo == "Valor") {
    $stmt = $conex->prepare("SELECT Valor FROM Jugador Where ID_Jugador = ?");
    $stmt->bind_param("i", $id);
}


$stmt->execute();


$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  
    if ($modo == "Goles") {
        echo "Goles: " . $row['Goles'];
    } elseif($modo ==  "Asistencias") {
        echo "Asistencias: " . $row['Asistencias'] . "<br>";
    } elseif($modo == "Partidos") {
        echo "Partidos Jugados: " . $row['Partidos_Jugados'] . "<br>";
    } elseif($modo == "Valor") {
        echo "Valor De Mercado: " . $row['Valor'] . "<br>";
    }
}

$stmt->close();
$conex->close();

?>


