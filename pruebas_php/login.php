<?php

    include('conexion.php');
    if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
        $usuario = $_POST['usuario'];
        $contraseña  = $_POST['contraseña'];
        $regexContraseña = '/(?=(.*[0-9]))(?=.*[!@#$%^&*()\\[\]{}\-_+=|:;"\'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/';
        if(empty($usuario)) {
            echo "El campo de usuario está vacío <br>";
        } elseif(strlen($usuario) < 6){
            echo "El campo de usuario tiene menos de 6 caracteres <br>";
        }
        if(empty($contraseña)){
            echo "El campo contraseña esta vacio <br>";
        } elseif(strlen($contraseña) <6){

            echo "El campo contraseña tiene menos de 6 caracteres";

        } 
        }
        $consulta = "SELECT * FROM Usuario WHERE Nombre_Usuario = '$usuario' AND Contraseña = '$contraseña'";
    
        $resultado = mysqli_query($conex, $consulta);

        if ($resultado) {
            $filas = mysqli_num_rows($resultado);
            if ($filas == 1) {
                // Usuario y contraseña coinciden, redirigir a la página de inicio
                header("Location: inicio.php");
                exit();
            } else {
                echo "Usuario y contraseña no coinciden";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conex);
        }
    

    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login StatRivals</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Iniciar Session</h1><br><br>


        <div class="form">
            <form  method="post" id="formulario" class="formulario">
                <div class="grupo">
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
                    <br><br>

                </div>
                <div class="grupo">
                    <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                    <br><br>

                </div>
            
        
                <button type="submit" value="Finalizar >" name="Finalizar" id="Finalizar">Enviar</button>
                <p class="warnings" id="warnings"><br></p>
                <br><br>
                <a href="He olvidado mi contraseña" class="olvidoContraseña">He olvidado la contraseña</a>
                <br><br>
                <a>No tienes usuario </a><a href="crea_usuario.php" class="Crear">Crea uno</a>
                <br><br>
                <a>No quieres usar usuario </a><a href="invitado" class="Invitado">Jugar como invitado</a>  

                </div>
            </form>
           
        </div>
            
        
        


  
    
</body>
</html>
