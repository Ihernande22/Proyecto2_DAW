<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StatRivals</title>
    <link rel="shortcut icon" href="img/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/index.js" defer></script>
</head>
<body>
    <!-- BARRA DE NAVEGACIÓN -->
    <nav>
    <div class="menu">
            <a class="logo" href="index.php"><img src="img/logo.png" alt="image"></a>
            <ul class="menu_lista">
                <li class="item"><a href="rankings.php">RANKINGS</a></li>
                <?php if ($_SESSION['logeado'] === TRUE): ?>
                <?php echo "<li class='logeado' id='nombreUsuario'>".$_SESSION['usuario']."</li>"?>
                <?php else: ?>
                <li class="login"><a href="login.php"><button>LOGIN</button></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!-- CONTENEDOR PARA SELECCIONAR EL MODO DE JUEGO -->
    <div class="container_modos" id="container_modos">
        <p id="modo" onchange="selectorModo()">
            <label><input type="radio" name="modoSel" id="goles" value="goles" checked><span>GOLES</span></label>
            <label><input type="radio" name="modoSel" id="asistencias" value="asistencias"><span>ASISTENCIAS</span></label>
            <label><input type="radio" name="modoSel" id="valor" value="valor"><span>VALOR €</span></label>
            <label><input type="radio" name="modoSel" id="partidos" value="partidos"><span>PARTIDOS</span></label>
        </p>
        <div id="desc_modo" class="desc_modo">
            <div id="texto" class="texto">
                <h4 id="modoTitulo">GOLES</h4>
                <p id="modoDescripcion">Infiere entre dos jugadores para intentar adivinar cuál de los dos ha anotado más goles a lo largo de su carrera.</p>
            </div>
            <div class="imagen" id="imagen">
                <img src="img/modo_goles.png" alt="image" id="modoImagen">
            </div>
        </div>
        <button class="boton_jugar" id="boton_jugar" onclick="crearInterfazConfigPartida()">JUGAR</button>
    </div>
</body>
</html>
