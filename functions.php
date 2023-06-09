<?php

require_once 'bd/conexion.php';

function validarRut($rut)
{
	$rut = preg_replace('/[^0-9kK-]/', '', $rut);
	if (strlen($rut) < 1) {
		return false;
	}

	$rut = str_pad($rut, 10, '0', STR_PAD_LEFT);
	$dv = strtoupper(substr($rut, -1));
	$numero = substr($rut, 0, strlen($rut) - 2);
	$suma = 0;
	$factor = 2;

	for ($i = strlen($numero) - 1; $i >= 0; $i--) {
		$suma += $factor * $numero[$i];
		$factor = $factor == 7 ? 2 : $factor + 1;
	}

	$dvEsperado = 11 - ($suma % 11);
	$dvEsperado = ($dvEsperado == 11) ? 0 : (($dvEsperado == 10) ? 'K' : $dvEsperado);
	return $dv == $dvEsperado;
}



// Función para validar el alias
function validarAlias($alias)
{
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
