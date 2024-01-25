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
    <form method="post">
    <div class="paramRankings">

        <!-- Seleccionar Modo de Juego -->
       
        <div class="seleccionMultiple">
            <div class="selector" onclick="showCheckBoxes('modo')">
                <select>
                    <option>Modo de Juego</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="CheckBoxesModo" class="CheckBoxes" name="CheckBoxesModo">
                <label for="rankings_modo_goles"><input type="checkbox" id="rankings_modo_goles" name="modos[]" value="1"/>GOLES</label>
                <label for="rankings_modo_asistencias"><input type="checkbox" id="rankings_modo_asistencias" name="modos[]" value="2"/>ASISTENCIAS</label>
                <label for="rankings_modo_partidos"><input type="checkbox" id="rankings_modo_partidos" name="modos[]" value="3"/>PARTIDOS</label>
                <label for="rankings_modo_valor"><input type="checkbox" id="rankings_modo_valor" name="modos[]" value="4"/>VALOR </label>
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
                <label for="rankings_liga_premier"><input type="checkbox" id="rankings_liga_premier" name="ligas[]" value="1">Premier League</label>
                <label for="rankings_liga_laliga"><input type="checkbox" id="rankings_liga_laliga" name="ligas[]" value="2">LaLiga</label>
                <label for="rankings_liga_bundesliga"><input type="checkbox" id="rankings_liga_bundesliga" name="ligas[]" value="3">Bundesliga</label>
                <label for="rankings_liga_seriea"><input type="checkbox" id="rankings_liga_seriea" name="ligas[]" value="4">Serie A</label>
                <label for="rankings_liga_aleatorio"><input type="checkbox" id="rankings_liga_aleatorio" name="ligas[]" value="5">Aleatorio</label>
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
                <label for="rankings_dificultad_normal"><input type="checkbox" id="rankings_dificultad_normal" name="dificultad[]" value="normal">Normal</label>
                <label for="rankings_dificultad_dificil"><input type="checkbox" id="rankings_dificultad_dificil" name="dificultad[]" value="dificil">Dificil</label>
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
                <label for="rankigns_usuarios_personal"><input type="radio" id="rankigns_usuarios_personal" name="rankings_usuarios" value="rankigns_usuarios_personal">Solo yo</label>
                <label for="rankigns_usuarios_global"><input type="radio" id="rankigns_usuarios_global" name="rankings_usuarios" value="rankigns_usuarios_global">Todos</label>
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
                <label for="rankigns_modoPuntuacion_acumulatoria"><input type="radio" id="rankigns_modoPuntuacion_acumulatoria" name="rankings_modoPuntuacion" value="rankigns_modoPuntuacion_acumulatoria">Acumulatorio</label>
                <label for="rankigns_modoPuntuacion_porPartida"><input type="radio" id="rankigns_modoPuntuacion_porPartida" name="rankings_modoPuntuacion" value="rankigns_modoPuntuacion_porPartida">Por partida</label>
            </div>
        </div>

    </div>
    <br><br>
    <button type="submit" name="submit" value="submit">Enviar</button>


    <?php

    require('conexion.php');
    if (isset($_POST['submit'])) {


        if(empty($_POST['rankings_usuarios']) || empty($_POST['rankings_modoPuntuacion'])){
            echo "Error";

        }
        else {
            $modos = $_POST["modos"];
            $ligas = $_POST['ligas'];
            $dificultad = $_POST['dificultad'];
            $modoPuntuacion = $_POST['rankings_modoPuntuacion'];
            $modoUsuario = $_POST['rankings_usuarios'];                   
            $query = "SELECT u.Nombre_Usuario as Usuario";
            $ejecutarQuery = TRUE;
            if ($modoUsuario === "rankigns_usuarios_personal") {
                if ($_SESSION['logeado'] === TRUE) { 
                    $id_usuario = "select * from Usuario where Nombre_Usuario like '".$_SESSION['usuario']."';";
                    if ($resultado = $conex->query($id_usuario)) {
                        while ($fila = $resultado->fetch_assoc()) {
                            $id_usuario = $fila['ID_Usuario'];
                        }
                    }
                    if($modoPuntuacion === "rankigns_modoPuntuacion_acumulatoria"){
                        $query = $query . ", (SELECT SUM(r.Puntuacion)FROM Registro_Partida r Where r.ID_Usuario = $id_usuario ";
        
                        if (count($modos) > 0) {
                            $query = $query.' AND  r.ID_Modo IN(';
                            for($i=0;$i<count($modos);$i++){
                                $query = $query . $modos[$i];
                                if($modos[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;
                        }
                                
                        if(count($ligas)> 0){
                            $query = $query . " and ID_Liga IN (";
                            for($i=0;$i<count($ligas);$i++){
                                $query = $query . $ligas[$i];
                                if($ligas[$i+1]){
                                    $query=$query . ", ";
                                    }
                                }
                            $query = $query . ") " ;    
                        }

                        if(count($dificultad)> 0){
                            $query = $query . " and Dificultad IN (";
                            for($i=0;$i<count($dificultad);$i++){
                                $query = $query . "'$dificultad[$i]'";
                                if($dificultad[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;    
                        }

                        $query = $query . ") AS Puntuacion FROM Usuario u HAVING Puntuacion > 0;";
                                

                    }
                    elseif ($modoPuntuacion === "rankigns_modoPuntuacion_porPartida") {
                        //AQUI
                        $query = $query . ", (SELECT MAX(rp2.Puntuacion)FROM Registro_Partida rp2 Where rp2.ID_Usuario = $id_usuario ";
                                
                        if (count($modos) > 0) {
                            $query = $query.' AND  rp2.ID_Modo IN(';
                            for($i=0;$i<count($modos);$i++){
                                $query = $query . $modos[$i];
                                if($modos[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;
                        }
                                    
                        if(count($ligas)> 0){
                            $query = $query . " and rp2.ID_Liga IN (";
                            for($i=0;$i<count($ligas);$i++){
                                $query = $query . $ligas[$i];
                                if($ligas[$i+1]){
                                    $query=$query . ", ";
                                    }
                                }
                                $query = $query . ") " ;    
                            }
    
                        if(count($dificultad)> 0){
                            $query = $query . " and rp2.Dificultad IN (";
                            for($i=0;$i<count($dificultad);$i++){
                                $query = $query . "'$dificultad[$i]'";
                                if($dificultad[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;    
                        }
                        //ESTOY AQUI
                        $query = $query . ") AS Puntuacion, ( SELECT rp2.Dificultad 
                        FROM Registro_Partida rp2 WHERE rp2.ID_Usuario = $id_usuario";
                        


                        if(count($modos) > 0){
                            $query = $query . " AND rp2.ID_Modo IN (";
                            for($i=0;$i<count($modos);$i++){
                                $query = $query . "'$modos[$i]'";
                                if($modos[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;
                           
                            }
                        if(count($ligas)> 0){
                            $query = $query . " AND rp2.ID_Liga IN (";
                            for($i=0;$i<count($ligas);$i++){
                                $query = $query . $ligas[$i];
                                if($ligas[$i+1]){
                                    $query=$query . ", ";
                                    }
                                }
                                $query = $query . ") " ;    
                            }
                        if(count($dificultad)> 0){
                            $query = $query . " and rp2.Dificultad IN (";
                            for($i=0;$i<count($dificultad);$i++){
                                $query = $query . "'$dificultad[$i]'";
                                if($dificultad[$i+1]){
                                    $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;    
                        }
    
                        //ESTOY AQUI
                        $query = $query . "ORDER BY rp2.Puntuacion DESC LIMIT 1) AS Dificultad FROM Usuario u HAVING Puntuacion > 0";
                    }
                }
                else {
                    $ejecutarQuery = FALSE;
                    echo "<p>Para usar esta funcionalidad necesitas estar logeado como usuario.</p>";
                }
            }
                
            elseif ($modoUsuario === "rankigns_usuarios_global") {
                if($modoPuntuacion === "rankigns_modoPuntuacion_acumulatoria"){
                    $query = $query . ", (SELECT SUM(r.Puntuacion)FROM Registro_Partida r Where r.ID_Usuario = u.ID_Usuario ";
    
                    if (count($modos) > 0) {
                        $query = $query.' AND  r.ID_Modo IN(';
                        for($i=0;$i<count($modos);$i++){
                            $query = $query . $modos[$i];
                            if($modos[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;
                    }
                            
                    if(count($ligas)> 0){
                        $query = $query . " and ID_Liga IN (";
                        for($i=0;$i<count($ligas);$i++){
                            $query = $query . $ligas[$i];
                            if($ligas[$i+1]){
                                $query=$query . ", ";
                                }
                            }
                        $query = $query . ") " ;    
                    }

                    if(count($dificultad)> 0){
                        $query = $query . " and Dificultad IN (";
                        for($i=0;$i<count($dificultad);$i++){
                            $query = $query . "'$dificultad[$i]'";
                            if($dificultad[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;    
                    }

                    $query = $query . ") AS Puntuacion FROM Usuario u HAVING Puntuacion > 0;";
                            

                }
                elseif ($modoPuntuacion === "rankigns_modoPuntuacion_porPartida") {
                    //AQUI
                    $query = $query . ", 
                        (SELECT MAX(rp2.Puntuacion)FROM Registro_Partida rp2 Where rp2.ID_Usuario = u.ID_Usuario ";
                            
                    if (count($modos) > 0) {
                        $query = $query.' AND  rp2.ID_Modo IN(';
                        for($i=0;$i<count($modos);$i++){
                            $query = $query . $modos[$i];
                            if($modos[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;
                    }
                                
                    if(count($ligas)> 0){
                        $query = $query . " and rp2.ID_Liga IN (";
                        for($i=0;$i<count($ligas);$i++){
                            $query = $query . $ligas[$i];
                            if($ligas[$i+1]){
                                $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;    
                        }

                    if(count($dificultad)> 0){
                        $query = $query . " and rp2.Dificultad IN (";
                        for($i=0;$i<count($dificultad);$i++){
                            $query = $query . "'$dificultad[$i]'";
                            if($dificultad[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;    
                    }

                    $query = $query . ") AS Puntuacion, ( SELECT rp2.Dificultad FROM Registro_Partida rp2 WHERE rp2.ID_Usuario = u.ID_Usuario"; 
                    
                    if(count($modos) > 0){
                        $query = $query . " AND rp2.ID_Modo IN (";
                        for($i=0;$i<count($modos);$i++){
                            $query = $query . "'$modos[$i]'";
                            if($modos[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;
                       
                        }
                    if(count($ligas)> 0){
                        $query = $query . " AND rp2.ID_Liga IN (";
                        for($i=0;$i<count($ligas);$i++){
                            $query = $query . $ligas[$i];
                            if($ligas[$i+1]){
                                $query=$query . ", ";
                                }
                            }
                            $query = $query . ") " ;    
                        }
                    if(count($dificultad)> 0){
                        $query = $query . " and rp2.Dificultad IN (";
                        for($i=0;$i<count($dificultad);$i++){
                            $query = $query . "'$dificultad[$i]'";
                            if($dificultad[$i+1]){
                                $query=$query . ", ";
                            }
                        }
                        $query = $query . ") " ;    
                    }

                    //ESTOY AQUI
                    $query = $query . "ORDER BY rp2.Puntuacion DESC LIMIT 1) AS Dificultad FROM Usuario u HAVING Puntuacion > 0";
                    
                    }
                }
       
            }
            if ($ejecutarQuery === TRUE) {
                echo $query;
                /*
                $contador = 0;
                $contadorQuery = str_replace(";","","select count(*) as contador from ($query) as subconsulta");
                $contadorQuery = $contadorQuery.";";
                if($resultado = $conex->query($contadorQuery)){
                 while ($row = $resultado->fetch_assoc()) {
                    $contador = $row['contador']; 
                 }
                }
                if ($contador > 0) {
                    if($resultado = $conex->query($query)){

                        ?>
                        <table id="tabla" border="1">
                        <tr>
                            <th>Usuario</th>
                            <th>Puntuacion</th>
                            
                        </tr>
        
                        <?php
                        while ($row = $resultado->fetch_assoc()) {

                                    echo "<tr>";
                                    echo "<td>" . $row["Usuario"] . "</td>";
                                    echo "<td>" . $row["Puntuacion"] . "</td>";
                                    echo "</tr>";
                        }
                       }
                }
                else {
                    echo "<p>No se han encontrado resultados</p>";
                }
                ?>
                </table>
                <?php
                */
               
            }

        }
        
    
    

    ?>

</form>
</body>
</html>
