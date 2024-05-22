<?php




function send2() {

    var formData = new FormData(document.getElementById("fromEmail2"));
    formData.append("dato", "valor");


    $.ajax({

        url: "emailController2.php",
        type: "post",
        // dataType: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {

            alert("Enviando...");
      
        },
        
        success: function(response) {
            console.log(response);
            if (response == 1) {

                console.log(response);

                alert("El correo ha sido enviado");
            } else {
                console.log(response);
                alert("El correo no se envió");

            }
        }
    })

    return false;
}
?>
