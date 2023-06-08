<?php

require_once './bd/conexion.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Formulario de Votación</title>
    <style>
        label {
        display: block;
        margin-bottom: 10px;
        }
    </style>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/form.js"></script>

</head>
  <body>

  <div id="formContainer">
    <h1>Formulario de Votación</h1>
    <form id="votingForm" action="process.php" method="POST">

      <label for="nombre">Nombre y Apellido:</label>
      <input type="text" id="nombre_apellido" name="nombre_apellido"><br>

      <label for="alias">Alias:</label>
      <input type="text" id="alias" name="alias"><br>

      <label for="rut">RUT:</label>
      <input type="text" id="rut" name="rut"><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br>


      <?php
      // Obtener las opciones de las regiones desde la base de datos
      $sql_regiones = "SELECT region_id, region_nombre FROM regiones";
      $result_regiones = $conn->query($sql_regiones);
      ?>
      <label for="region">Región:</label>
      <select id="region" name="region">
        <option value="">Selecciona una región</option>
        <?php
        if ($result_regiones->num_rows > 0) {
          while ($row = $result_regiones->fetch_assoc()) {
            echo "<option value='" . $row['region_id'] . "'>" . $row['region_nombre'] . "</option>";
          }
        }
        ?>
      </select><br>


      <?php
      // Obtener las opciones de las comunas desde la base de datos
      $sql_comunas = "Select c.comuna_id, c.comuna_nombre
      From comunas c
      Inner Join provincias p On p.provincia_id = c.provincia_id
      Where p.region_id = 7";
      $result_comunas = $conn->query($sql_comunas);
      ?>
      <label for="comuna">Comuna:</label>
      <select id="comuna" name="comuna" >
        <option value="">Selecciona una comuna</option>
        <?php
        if ($result_comunas->num_rows > 0) {
          while ($row = $result_comunas->fetch_assoc()) {
            echo "<option value='" . $row['comuna_id'] . "'>" . $row['comuna_nombre'] . "</option>";
          }
        }
        ?>
      </select><br>

    <?php
    // Obtener las opciones de los candidatos desde la base de datos
    $sql_candidatos = "SELECT id_candidato, nombre_candidato FROM candidatos";
    $result_candidatos = $conn->query($sql_candidatos);
    ?>

      <label for="candidato">Candidato:</label>
      <select id="candidato" name="candidato">
        <option value="">Selecciona un candidato</option>
        <?php
            if ($result_candidatos->num_rows > 0) {
                while ($row = $result_candidatos->fetch_assoc()) {
                echo "<option value='" . $row['id_candidato'] . "'>" . $row['nombre_candidato'] . "</option>";
                }
            }
        ?>
      </select><br>

      <label>¿Cómo se enteró de nosotros?:</label>
      <input type="checkbox" id="web" name="como_se_entero[]" value="web">
      <label for="web">Web</label>

      <input type="checkbox" id="tv" name="como_se_entero[]" value="tv">
      <label for="tv">TV</label>

      <input type="checkbox" id="redes_sociales" name="como_se_entero[]" value="redes_sociales">
      <label for="redes_sociales">Redes Sociales</label>

      <input type="checkbox" id="amigo" name="como_se_entero[]" value="amigo">
      <label for="amigo">Amigo</label><br>

      <button type="submit">Votar</button>
    </form>
  </div>

  
      
  </body>

</html>