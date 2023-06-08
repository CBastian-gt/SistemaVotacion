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

$errors = array(); // Variable para almacenar los mensajes de error

// Validación de Nombre y Apellido
if (empty($nombre_apellido)) {
  $errors[] = "Por favor, ingresa tu Nombre y Apellido.";
}

// Validación de Alias
if (strlen($alias) <= 5 || !ctype_alnum($alias)) {
  $errors[] = "El Alias debe tener al menos 6 caracteres y contener solo letras y números.";
}

// Validación de RUT
if (!preg_match('/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}[-][0-9kK]{1}$/', $rut)) {
  $errors[] = "Por favor, ingresa un RUT válido en formato chileno.";
}

// Validación de Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Por favor, ingresa un correo electrónico válido.";
}

$sql = "INSERT INTO votaciones (nombre_apellido, alias, rut, email, region, comuna, candidato, como_se_entero)
        VALUES ('$nombre_apellido', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$como_se_entero')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}