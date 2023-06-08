<?php
if (isset($_POST['region_id'])) {
  $regionId = $_POST['region_id'];

  // Aquí realizas la consulta a tu base de datos para obtener las comunas de la región
  // ...

  // Construir las opciones del campo de selección de comuna
  $options = "";
  if ($result_comunas->num_rows > 0) {
    while ($row = $result_comunas->fetch_assoc()) {
      $options .= "<option value='" . $row['comuna_id'] . "'>" . $row['comuna_nombre'] . "</option>";
    }
  }

  // Preparar la respuesta JSON
  $response = [
    'options' => $options
  ];

  // Enviar la respuesta JSON con las opciones de comuna
  header('Content-Type: application/json');
  echo json_encode($response);
  exit;
}
?>
