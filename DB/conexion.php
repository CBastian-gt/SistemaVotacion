<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "formulariovotacion"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres de la conexión
$conn->set_charset("utf8");


?>
