 	
// A $( document ).ready() block.
$( document ).ready(function() {
    $("#votingForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            data: $("#votingForm").serialize(),
            url:   'process.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                alert(response);
            }
        });

    });

    $('#region').on('change', function() {
        console.log($(this).val());
    });
    
});
