<?php

    include("conexion.php");
  
    $finalizar = $_REQUEST['Finalizar'];

    echo "Connected successfully";
  

    if(isset($finalizar)){
        echo "iiii";

        if(strlen($_POST['usuario']) >1 && strlen($_POST['contraseña']) > 1){
            echo "iiii";
            $nombre = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $consulta = "INSERT INTO `Usuario` (`ID_Usuario`, `Nombre_Usuario`, `Correo_Electronico`, `Contraseña`) VALUES (NULL, '$nombre', '', '$contraseña')";
            $resultado = mysqli_query($conex,$consulta);
            if($resultado){
                echo "Insert okey";
            }else{
                echo "Insert Fallido";
            }
        }
    }
?>
