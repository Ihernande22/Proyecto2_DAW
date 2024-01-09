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
        <h2>Reestablecer Contraseña</h2>
        <form action="" method="post">
            <p>Enviar correo de verificación a <span id="correoPasswordOlvidada">i···········@gmail.com&nbsp;</span>para verificar su identidad</p>
            <button onclick="">Enviar</button>
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