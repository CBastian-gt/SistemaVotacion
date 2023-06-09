$( document ).ready(function() {
    // Se ejecuta cuando el documento está listo
    $("#votingForm").submit(function(e){
        e.preventDefault();
        // Evita que el formulario se envíe de forma predeterminada
        $.ajax({
            data: $("#votingForm").serialize(),
            url:   'process.php', 
            type:  'post', 
            success:  function (response) {
                alert(response);
                // Muestra una alerta con la respuesta del servidor
                
                window.location.href = 'index.php';
                // Redirecciona a index.php
            }
        });
    });

    $('#region').on('change', function() {
        // Se ejecuta cuando hay un cambio en el elemento con ID "region"
        let regionId = $(this).val();
        // Obtiene el valor seleccionado en el elemento "region"
        if (regionId == ""){
            $("#comuna").html('<option value="">Selecciona una comuna</option>');
            return;
        };
        $.ajax({
            data: { region : regionId },
            url:   'comunas.php', 
            type:  'post', 
            success:  function (response) {
                $("#comuna").html(response);
                // Actualiza el contenido del elemento "comuna" con la respuesta del servidor
            }
        });
        
    });
});