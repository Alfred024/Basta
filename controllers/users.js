var popUp = '';

function users(action, id) {
    if(typeof(id) === "undefined") id = 0;

    switch (action) {
        case 'formNew':
            $.ajax({
                url: "../classes/class_user.php",
                type: "post",
                data: {action: "formNew"},
                success: function(htmlResponse){
                    console.log('Petición para form de registro');
                    workArea.innerHTML = htmlResponse;
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
            break;
        case 'insert':
            const formData = $('#form_user').serialize();
            $.ajax({
                url: "../classes/class_user.php",
                type: "post",
                data: {action: "insert"},
                success: function(htmlResponse){
                    console.log('Petición para form de registro');
                    workArea.innerHTML = htmlResponse;
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
            break;
        case 'update':
            
            break;
        case 'delete':
            
            break;
        case 'validateRegister':
            message.innerHTML="";
            if(passw1.value == passw2.value && passw1.value>""){
                return true;
            }else{
                // $("#message").delay(2000).show("fast", "swing");
                message.innerHTML="<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'>Las constraseñas no coinciden o hay un campo vacío </p>";
                return false;
            }
        default:
            alert('Opción inválida.');
            break;
    }
}