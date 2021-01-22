<?php

  include('database.php');

if(isset($_POST['codigo'])) {
  $alu_nombres = $_POST['nombres']; 
  $alu_telefono = $_POST['telefono'];
  $alu_direccion = $_POST['direccion'];
  $codigo = $_POST['codigo'];
  $query = "UPDATE alumnos SET nombres = '$alu_nombres',telefono = $alu_telefono, direccion = '$alu_direccion' WHERE codigo = '$codigo'";
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die('Fallo');
  }

  echo "Agregado Satisfactoriamente";   

}

?>
