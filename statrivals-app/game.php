<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del POST
    $modo = $_POST["modo"];
    $liga = $_POST["liga"];
    $dificultad = $_POST["dificultad"];

    // Puedes realizar acciones con los datos, como actualizar la base de datos, etc.

    // Añade mensajes de depuración
    echo "Configuraciones recibidas: Modo=$modo, Liga=$liga, Dificultad=$dificultad";
} else {
    // Manejar el caso en el que no sea una solicitud POST
    echo "Error: Se esperaba una solicitud POST.";
}
?>

</body>
</html>
