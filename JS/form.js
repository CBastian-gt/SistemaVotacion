$( document ).ready(function() {
    $("#votingForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            data: $("#votingForm").serialize(),
            url:   'process.php', 
            type:  'post', 
            success:  function (response) {
                alert(response);
            }
        });

    });



    $('#region').on('change', function() {
        var regionId = $(this).val();
        
        // Realizar la solicitud AJAX para obtener las comunas
        $.ajax({
            url: 'fetch_comunas.php',
            type: 'POST',
            data: { region_id: regionId },
            dataType: 'json',
            success: function(response) {
                // Actualizar las opciones del campo de selección de comuna
                var options = '';
                if (response.success) {
                    $.each(response.comunas, function(index, comuna) {
                        options += '<option value="' + comuna.comuna_id + '">' + comuna.comuna_nombre + '</option>';
                    });
                }
                $('#comuna').html(options);
                
                // Habilitar el campo de selección de comuna
                $('#comuna').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.log('Error al obtener las comunas: ' + error);
            }
        });
    });



});
