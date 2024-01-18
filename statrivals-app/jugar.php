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
    <script src="js/index.js" defer></script>
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
</body>
</html>