<?php

require_once './DB/conexion.php';

$nombre_apellido = $_POST["nombre_apellido"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$como_se_entero = $_POST["como_se_entero"];

function validarRut($rut) {
    $rut = preg_replace('/[^0-9kK]/', '', $rut);
  
    if (strlen($rut) < 1) {
      return false;
    }
  
    $rut = str_pad($rut, 10, '0', STR_PAD_LEFT);
  
    $dv = strtoupper(substr($rut, -1));
    $numero = substr($rut, 0, strlen($rut) - 1);
  
    $suma = 0;
    $factor = 2;
  
    for ($i = strlen($numero) - 1; $i >= 0; $i--) {
      $suma += $factor * $numero[$i];
      $factor = $factor == 7 ? 2 : $factor + 1;
    }
  
    $dvEsperado = 11 - ($suma % 11);
    $dv = $dv == 'K' ? 10 : $dv;
  
    return $dv == $dvEsperado;
  }


  if (!validarRut($rut)) {
    echo "El RUT ingresado no es válido";
    // Aquí puedes redirigir al usuario a la página anterior o mostrar un mensaje de error
    exit;
  }
  


$sql = "INSERT INTO votaciones (nombre_apellido, alias, rut, email, region, comuna, candidato, como_se_entero)
        VALUES ('$nombre_apellido', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$como_se_entero')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}