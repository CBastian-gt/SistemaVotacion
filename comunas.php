<?php

require_once 'bd/conexion.php';
$region = isset($_POST["region"]) ? $_POST["region"] : null;

if (empty($region)) {
    echo '';
    exit;
}

$sql_comunas = "SELECT comuna_id, comuna_nombre
                FROM comunas
                INNER JOIN provincias On provincias.provincia_id = comunas.provincia_id
                WHERE region_id = " . $region . " ORDER BY comuna_nombre";
$result_comunas = $conn->query($sql_comunas);
$html = '<option value="">Selecciona una comuna</option>';
if ($result_comunas->num_rows > 0) {
    while ($row = $result_comunas->fetch_assoc()) {
        $html = $html . "<option value='" . $row['comuna_id'] . "'>" . $row['comuna_nombre'] . "</option>";
    }
}
echo $html;
