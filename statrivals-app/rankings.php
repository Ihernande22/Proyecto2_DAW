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
    <link rel="stylesheet" href="css/rankings.css">
    <script src="js/rankings.js" defer></script>
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
    <h1>RANKINGS</h1>
    <!-- CONTENEDOR PARA SELECCIONAR LOS PARAMETROS DE LOS RANKING -->
    <div class="paramRankings">

        <!-- Seleccionar Modo de Juego -->
        <div class="seleccionMultiple"> 
            <div class="selector" onclick="showCheckBoxes('modo')"> 
                <select> 
                    <option>Modo de Juego</option> 
                </select> 
                <div class="overSelect"></div> 
            </div> 
            <div id="CheckBoxesModo" class="CheckBoxes"> 
                <label for="rankings_modo_goles"><input type="checkbox" id="rankings_modo_goles"/>GOLES</label> 
                <label for="rankings_modo_asistencias"><input type="checkbox" id="rankings_modo_asistencias"/>ASISTENCIAS</label> 
                <label for="rankings_modo_partidos"><input type="checkbox" id="rankings_modo_partidos"/>PARTIDOS</label> 
                <label for="rankings_modo_valor"><input type="checkbox" id="rankings_modo_valor"/>VALOR </label> 
            </div> 
        </div>

        <!-- Seleccionar Liga -->
        <div class="seleccionMultiple">
            <div class="selector" onclick="showCheckBoxes('liga')">
                <select>
                    <option>Liga</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="CheckBoxesLiga" class="CheckBoxes">
                <label for="rankings_liga_premier"><input type="checkbox" id="rankings_liga_premier">Premier League</label>
                <label for="rankings_liga_laliga"><input type="checkbox" id="rankings_liga_laliga">LaLiga</label>
                <label for="rankings_liga_bundesliga"><input type="checkbox" id="rankings_liga_bundesliga">Bundesliga</label>
                <label for="rankings_liga_seriea"><input type="checkbox" id="rankings_liga_seriea">Serie A</label>
                <label for="rankings_liga_aleatorio"><input type="checkbox" id="rankings_liga_aleatorio">Aleatorio</label>
            </div>
        </div>

        <!-- Seleccionar Dificultad -->
        <div class="seleccionMultiple">
            <div class="selector" onclick="showCheckBoxes('dificultad')">
                <select>
                    <option>Dificultad</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="CheckBoxesDificultad" class="CheckBoxes">
                <label for="rankings_dificultad_normal"><input type="checkbox" id="rankings_dificultad_normal">Normal</label>
                <label for="rankings_dificultad_dificil"><input type="checkbox" id="rankings_dificultad_dificil">Dificil</label>
            </div>
        </div>

        <!-- Seleccionar Usuario -->
        <div class="seleccionUnica">
            <div class="selector" onclick="showRadioButtons('usuarios')">
                <select>
                    <option>Usuarios</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="RadioButtonsUsuarios" class="RadioButtons">
                <label for="rankigns_usuarios_personal"><input type="radio" id="rankigns_usuarios_personal" name="rankings_usuarios">Solo yo</label>
                <label for="rankigns_usuarios_global"><input type="radio" id="rankigns_usuarios_global" name="rankings_usuarios">Todos</label>
            </div>
        </div>

        <!-- Seleccionar Modo de Puntuación -->
        <div class="seleccionUnica">
            <div class="selector" onclick="showRadioButtons('modoPuntuacion')">
                <select>
                    <option>Modo Puntuacion</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="RadioButtonsModoPuntuacion" class="RadioButtons">
                <label for="rankigns_modoPuntuacion_acumulatoria"><input type="radio" id="rankigns_modoPuntuacion_acumulatoria" name="rankings_modoPuntuacion">Acumulatorio</label>
                <label for="rankigns_modoPuntuacion_porPartida"><input type="radio" id="rankigns_modoPuntuacion_porPartida" name="rankings_modoPuntuacion">Por partida</label>
            </div>
        </div>

    </div>
</body>
</html>