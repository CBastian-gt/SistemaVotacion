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
        let regionId = $(this).val();
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
            }
        });
        
    });
        
});
