<?php

include('database.php');

if(isset($_POST['codigo'])) {
  $codigo = $_POST['codigo'];
  $query = "DELETE FROM alumnos WHERE codigo = $codigo"; 
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die('Fallo');
  }

  echo "Agregado Satisfactoriamente";   

}

?>
