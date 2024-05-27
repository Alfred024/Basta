var popUp = '';

function users(action, id, text) {
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
        case 'formEdit':
            $.dialog({
                title: 'Edición de usuario',
                columnClass: 'col-7',
                content: `url: ../classes/class_user.php?action=${action}&id_user_to_update=${id}`, // Aquí le pasamos el ID del usuario
                onContentReady: function () {
                    ventFrame = this;
                },
            });
            break;
        case 'inserta':
            // data = $('#form_user').serialize();
            $.ajax({
                url: "../classes/class_user.php",
                type: "post",
                data: { action: porque_esto_funciona },
                success: function(htmlResponse){
                    console.log('Petición para insert de registro');
                    workArea.innerHTML = htmlResponse;
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
            return false; // Porqué ponemos este return false
        case 'update':
            alert('ACTUALIZACIÓN');
            break;
        case 'delete':
            $.confirm({
                'title': '¿Seguro que desea borrar el usuario?',
                'type': 'red',
                'buttons': {
                    confirm: function(){
                        $.ajax({
                            url: "../classes/class_user.php",
                            type: "post",
                            data: {action: "delete", id_user: id},
                            success: function(htmlResponse){
                                console.log('Registro borrado');
                                workArea.innerHTML = htmlResponse;
                            },
                            error: function(err){ console.log(JSON.stringify(err)); },
                        });
                    }
                }
            });
            break;
        case 'validateRegister':
            message.innerHTML="";
            if(clave.value == clave2.value && clave.value>""){
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