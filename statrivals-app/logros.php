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
    <link rel="stylesheet" href="css/logros.css">
    <script src="js/logros.js" defer></script>
</head>
<body>
    <!-- BARRA DE NAVEGACIÓN -->
    <nav>
        <div class="menu">
            <a class="logo" href="index.php"><img src="img/logo.png" alt="image"></a>
            <ul class="menu_lista">
                <li class="item"><a href="logros.php">LOGROS</a></li>
                <li class="item"><a href="rankings.php">RANKINGS</a></li>
                <?php if ($_SESSION['logeado'] === TRUE): ?>
                <?php echo "<li class='logeado' id='nombreUsuario'>".$_SESSION['usuario']."</li>"?>
                <?php else: ?>
                <li class="login"><a href="login.php"><button>LOGIN</button></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="Contenido">
        <div class="parteSuperior">
            <!-- BARRA CON PROGRESO -->
            <div class="BarraProgresoLogros">
                <h2>LOGROS:<span> 0%</span></h2>
            </div>
            <div class="Indicaciones">
                <div class="Indicacion">
                    <div class="Cuadrado"></div>
                    <p>Completados</p>
                </div>
                <div class="Indicacion">
                    <div class="Cuadrado"></div>
                    <p>No Completados</p>
                </div>
            </div>
        </div>
        <div class="botonesFiltrar">
            <p id="filtroLogros">
                <label><input type="radio" name="filtroLogros" value="todos"><span>Todos</span></label>
                <label><input type="radio" name="filtroLogros" value="completados"><span>Completado</span></label>
                <label><input type="radio" name="filtroLogros" value="noCompletados"><span>No completados</span></label>
            </p>
        </div>
    </div>
    <div id="containerLogros">
        <div id="logro">
            <div id="logro-header">
                <h5>Juega 1 partida en modo difícil.</h5>
            </div>
            <div id="logro-img">
                <img src="img/logros/1.png" alt="img_logro">
            </div>
        </div>
        <div id="logro">
            <div id="logro-header">
                <h5>Consigue 30 puntos en una partida con la Bundesliga.</h5>
            </div>
            <div id="logro-img">
                <img src="img/logros/2.png" alt="img_logro">
            </div>
        </div>
        <div id="logro">
            <div id="logro-header">
                <h5>Consigue 100 puntos.</h5>
            </div>
            <div id="logro-img">
                <img src="img/logros/3.png" alt="img_logro">
            </div>
        </div>
        <div id="logro">
            <div id="logro-header">
                <h5>Me lo he inventao.</h5>
            </div>
            <div id="logro-img">
                <img src="img/logros/2.png" alt="img_logro">
            </div>
        </div>
        <div id="logro">
            <div id="logro-header">
                <h5>Me lo he inventao x2.</h5>
            </div>
            <div id="logro-img">
                <img src="img/logros/1.png" alt="img_logro">
            </div>
        </div>
    </div>
</body>
</html>