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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php 
    //COMPRUEBA SI EL USUARIO ESTA LOGEADO
    //SI LO ESTA MUESTRA UN MENSAJE DE ERROR
    if ($_SESSION['logeado'] === TRUE) {
        echo "<div class='registroCorrecto'>";
        echo "<p class='logeadoYa'>La sesión esta iniciada</p>";
        echo "<a href='index.php'>Volver</a>";
        echo "</div>";
    }
    //SI NO LO ESTA
    else {
        //COMPRUEBA SI SE HA PASADO EL CORREO DEL USUARIO
        //SI SE HA PASADO
        if (isset($_SESSION['correoRecuperacion'])) {
            //COMPRUEBA SI SE HA VALIDADO EL CODIGO
            if ($_SESSION['codigoValidado'] === TRUE) {
                ?>
                <div id="ContenedorFormLogin">
                    <?php
                        if (isset($_SESSION['mensajeError'])) {
                            echo "<div class='contError'>";
                            echo "<p class='errorFormLogin'>".$_SESSION['mensajeError']."</p>";
                            echo "</div>";
                            $_SESSION['mensajeError'] = null;
                        }
                    ?>
                    <h2>Recuperar Contraseña</h2>
                    <p>Introduce la nueva contraseña que vas a utilizar.</p>
                    <form method="post" action="recuperarPwd4.php">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                    <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Repetir contraseña">
                        <button type="submit">Enviar</button>
                    </form>
                    <br>
                    <br>
                    <a href="passwordOlvidadaLogout.php" style="text-align: center;">Volver</a>
                </div>
                <?php
            }
            else {
                //COMPRUEBA SI SE HA ENVIADO YA EL CODIGO AL USUARIO
                //SI SE HA ENVIADO
                if ($_SESSION['codigoEnviado'] === TRUE) {
                    ?>
                    <div id="ContenedorFormLogin">
                        <?php
                            if (isset($_SESSION['mensajeError'])) {
                                echo "<div class='contError'>";
                                echo "<p class='errorFormLogin'>".$_SESSION['mensajeError']."</p>";
                                echo "</div>";
                                $_SESSION['mensajeError'] = null;
                            }
                        ?>
                        <h2>Recuperar Contraseña</h2>
                        <form method="post" action="recuperarPwd3.php">
                        <?php
                            // Obtiene el nombre de usuario (los primeros tres caracteres)
                            $nombre_usuario = substr($_SESSION['correoRecuperacion'], 0, 3);
                            // Obtiene el dominio (a partir del carácter '@')
                            $arroba_posicion = strpos($_SESSION['correoRecuperacion'], '@');
                            $dominio = substr($_SESSION['correoRecuperacion'], $arroba_posicion);
                            // Forma el correo recortado
                            $correo_recortado = $nombre_usuario . str_repeat('*', $arroba_posicion - 3) . $dominio;
                        ?>

                            <p>Te hemos enviado un código de verificación al correo electrónico <em><?php echo $correo_recortado; ?></em></p>
                            <input type="text" name="codigoVerificacion" id="codigoVerificacion" placeholder="Codigo">
                            <button type="submit">Enviar</button>
                        </form>
                        <br>
                        <br>
                        <a href="passwordOlvidadaLogout.php" style="text-align: center;">Volver</a>
                    </div>
                <?php
                }
                //SI NO SE HA ENVIADO
                else {
                    ?>
                    <div id="ContenedorFormLogin">
                        <?php
                            if (isset($_SESSION['mensajeError'])) {
                                echo "<div class='contError'>";
                                echo "<p class='errorFormLogin'>".$_SESSION['mensajeError']."</p>";
                                echo "</div>";
                                $_SESSION['mensajeError'] = null;
                            }
                        ?>
                        <h2>Recuperar Contraseña</h2>
                        <form method="post" action="recuperarPwd2.php">
                        <?php
                            // Obtiene el nombre de usuario (los primeros tres caracteres)
                            $nombre_usuario = substr($_SESSION['correoRecuperacion'], 0, 3);
                            // Obtiene el dominio (a partir del carácter '@')
                            $arroba_posicion = strpos($_SESSION['correoRecuperacion'], '@');
                            $dominio = substr($_SESSION['correoRecuperacion'], $arroba_posicion);
                            // Forma el correo recortado
                            $correo_recortado = $nombre_usuario . str_repeat('*', $arroba_posicion - 3) . $dominio;
                        ?>

                            <p>Te vamos a enviar un código de verificación al correo electrónico <em><?php echo $correo_recortado; ?></em></p>

                            <button type="submit">Enviar</button>
                        </form>
                        <br>
                        <br>
                        <a href="passwordOlvidadaLogout.php" style="text-align: center;">Volver</a>
                    </div>
                <?php
                }
            }
        }
        //SI NO SE HA PASADO MUESTRA EL FORMULARIO
        else {
            ?>
                <div id="ContenedorFormLogin">
                    <?php
                        if (isset($_SESSION['mensajeError'])) {
                            echo "<div class='contError'>";
                            echo "<p class='errorFormLogin'>".$_SESSION['mensajeError']."</p>";
                            echo "</div>";
                            $_SESSION['mensajeError'] = null;
                        }
                    ?>
                    <h2>Recuperar Contraseña</h2>
                    <form method="post" action="recuperarPwd1.php">
                        <input type="text" id="usuarioRecuperacion" name="usuarioRecuperacion" placeholder="Nombre de usuario">
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            <?php
        }
    }    
?>
</body>
</html>