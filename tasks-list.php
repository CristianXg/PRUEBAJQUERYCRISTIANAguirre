<?php

  include('database.php');

  $query = "SELECT * from alumnos";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conexion));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'nombres' => $row['nombres'],
      'telefono'=> $row['telefono'],
      'direccion' => $row['direccion'],
      'codigo' => $row['codigo']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>
