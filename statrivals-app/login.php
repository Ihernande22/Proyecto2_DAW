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
        if ($_SESSION['logeado'] === TRUE) {
            echo "<p class='logeadoYa'>Esta funcionalidad esta desactivada mientras la sesión esta iniciada</p>";
            echo "<a href='index.php'>Volver</a>";
        }
        else {
    ?>
        <!-- Logo -->
        <a href="index.php" id="logo"><img src="img/logo.png" alt="image"></a>

        <!-- FORMULARIO LOGIN -->
        <div id="ContenedorFormLogin">
            <?php
                if (isset($_SESSION['mensajeError'])) {
                    echo "<div class='contError'>";
                    echo "<p class='errorFormLogin'>".$_SESSION['mensajeError']."</p>";
                    echo "</div>";
                    $_SESSION['mensajeError'] = null;
                }
            ?>
            <h2>Iniciar sesión</h2>
            <form action="procesarInicioSesion.php" method="post">
                <input type="text" name="nombreUsuario" placeholder="Nombre de usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <button type="submit" name='iniciar_sesion'>Iniciar sesión</button>
                <hr>
                <div id="OtrasOpciones">
                    <div id="passwordOlvidada">
                        Has olvidado tu contraseña?&nbsp;<a href="reestablecer_password.php" onclick="">Reestablecer</a>
                    </div>
                    <div id="sinUsuario">
                        No tienes un usuario creado?&nbsp;<a href="registrar.php">Crea uno</a>
                    </div>
                    <div id="JugarInvitado">
                        <a href="index.php">Jugar como invitado</a>
                    </div>
                </div>
            </form>
        </div>
    <?php
        }
    ?>
    <footer>
        <p>© 2023 Izan Villaécija y Iker Hernández. Todos los derechos reservados.</p>
        <a href="">Política de privacidad</a>
    </footer>
</body>
</html>