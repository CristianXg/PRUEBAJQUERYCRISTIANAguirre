<?php

  include('database.php');

if(isset($_POST['nombres'])) {
  $alu_nombres = $_POST['nombres'];
  $alu_telefono = $_POST['telefono'];
  $alu_direccion = $_POST['direccion'];
  $query = "INSERT into alumnos(nombres, telefono, direccion) VALUES ('$alu_nombres',$alu_telefono, '$alu_direccion')";
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die('Fallo');
  }

  echo "Agregado Satisfactoriamente";  

}

?>
