<?php

include('database.php');

if(isset($_POST['codigo'])) {
  $codigo = mysqli_real_escape_string($conexion, $_POST['codigo']);

  $query = "SELECT * from alumnos WHERE codigo = {$codigo}";

  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conexion));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'nombres' => $row['nombres'],
      'telefono' => $row['telefono'],
      'direccion' => $row['direccion'],
      'codigo' => $row['codigo']
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

?>
