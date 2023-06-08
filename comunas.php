<?php

require_once 'bd/conexion.php';
$region = isset($_POST["region"]) ? $_POST["region"] : null;

if (empty($region)) {
    echo '';
    exit;
}



?>