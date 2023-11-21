<?php
  include('conexion.php');

  if(isset($_POST['Insertar'])){

    

  
  if(strlen($_POST['correo']) >0 && strlen($_POST['UsuarioNuevo']) >0 && strlen($_POST['ContraseñaNuevoUsuario']) >0){
    $correo = $_POST['correo'];
    $nombre = $_POST['UsuarioNuevo'];
    $contraseña = $_POST['ContraseñaNuevoUsuario'];
    $consulta = "INSERT INTO Usuario( Nombre_Usuario ,  Correo_Electronico , Contraseña) VALUES ('$nombre','$correo','$contraseña')";
    $resultado = mysqli_query($conex,$consulta);

    if($resultado){
      ?>
      <h3>Te has inscrito correctamente </h3>
      <?php
    }else{
      ?>

      <h3>Error </h3>




      <?php
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validacion</title>
</head>
<body>
   
      <h1>Prueba<h1>
</body>
</html>
