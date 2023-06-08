<?php

require_once './DB/conexion.php';

$nombre_apellido = $_POST["nombre_apellido"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$como_se_entero = isset($_POST["como_se_entero"]) ? $_POST["como_se_entero"] : [];

$valido = true;

if (empty($nombre_apellido)) {
    echo "El nombre y apellido no puede quedar en blanco. \n";
    $valido = false;
}

// Validar el alias
if (!validarAlias($alias)) {
    echo "El alias debe contener letras y números. \n";
    $valido = false;
}

// Validar la duplicación de votos por RUT si el campo no está vacío
if (!empty($rut)) {
    $sql_duplicados = "SELECT COUNT(*) AS count FROM votaciones WHERE rut = '$rut'";
    $result_duplicados = $conn->query($sql_duplicados);

    if ($result_duplicados && $result_duplicados->num_rows > 0) {
        $row = $result_duplicados->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            echo "El RUT ingresado ya ha votado. \n";
            $valido = false;
        }
    }
}

// Validar el rut
if (!validarRut($rut)) {
    echo "El RUT ingresado no es válido. \n";
    $valido = false;
}

// Validar el correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "El correo electrónico no es válido. \n";
    $valido = false;
}

// Validar region
if (empty($region)) {
    echo "Debes seleccionar una región. \n";
    $valido = false;
}

// Validar comuna
if (empty($comuna)) {
    echo "Debes seleccionar una comuna. \n";
    $valido = false;
}

// Convertir a arreglo si es una cadena de texto
if (!is_array($como_se_entero)) {
    $como_se_entero = [$como_se_entero];
}

// Validar como_se_entero
if (count($como_se_entero) < 2) {
    echo "Debes seleccionar al menos dos opciones en \"Como se enteró de Nosotros\".";
    $valido = false;
}

if ($valido) {
    $sql = "INSERT INTO votaciones (nombre_apellido, alias, rut, email, region, comuna, candidato, como_se_entero)
        VALUES ('$nombre_apellido', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$como_se_entero')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
}


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



  // Función para validar el alias
function validarAlias($alias) {
    // Verificar la longitud del alias
    if (strlen($alias) <= 5) {
      return false;
    }
  
    // Verificar si contiene letras y números
    if (!preg_match('/[a-zA-Z]/', $alias) || !preg_match('/[0-9]/', $alias)) {
      return false;
    }
  
    return true;
  }