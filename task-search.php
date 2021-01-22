<?php

include('database.php');

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $query = "SELECT * FROM alumnos WHERE nombres LIKE '$search%'";
  $result = mysqli_query($conexion, $query);
    
  if(!$result) {
    die('Query Error' . mysqli_error($conexion));
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
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>
