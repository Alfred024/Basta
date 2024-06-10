var popUp = '';
var ventFrame = '';

function users(action, id, text) {
    if(typeof(id) === "undefined") id = 0;
    
    switch (action) {
        case 'profile':
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
        case 'inserta':
            //data = $('#form_user').serialize();
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
        case "update": 
            formData = new FormData(document.getElementById("form_user"));
            $.ajax({url: "../classes/class_user.php",
                   type: "post",
                   dataType: "html",
                   data: formData,
                   cache: false,
                   contentType: false,
                   processData: false,
                   success: function(result){
                    console.log('UPDATE DEL FORM');
                    // RESULT -> 
                    // actualizar el nombre y la foto en la vista. (2 tiempso difs. con 2 lengujaes difs.)
                    username.innerHTML = nombre_id.value;
                    userphoto.src = `../files/profile_pictures/nombre_archivo_foto`;
                    // Cerrar la ventana abierta.
                    ventFrame.close();
                    // alerta("Atención","Datos actualizados!!")
                    alert('Datos del usuario actualizados');
                  },
            });
            return false;
        case 'delete':
            $.confirm({
                'title': '¿Seguro que desea borrar el usuario?',
                'type': 'red',
                'content': `Seguro que desea borrar el usuario con id ${id}`,
                'buttons': {
                    confirm: {
                        text: 'Confirmar',
                        action: function(){
                            $.ajax({
                                url: "../classes/class_user.php",
                                type: "post",
                                data: {action: "delete", id_user: id},
                                success: function(htmlResponse){
                                    console.log('Registro borrado');
                                    workArea.innerHTML = htmlResponse;
                                },
                                error: function(err){ 
                                    console.log(JSON.stringify(err)); 
                                },
                            });
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                        action: function(){
                            console.log('Acción cancelada');
                            // Puedes agregar cualquier acción adicional si es necesario
                        }
                    }
                }
            });
            
            break;
        case 'validateRegister':
            message.innerHTML="";
            if(clave.value == clave2.value && clave.value>""){
                return true;
            }else{
                //
                
                // $("#message").delay(2000).show("fast", "swing");
                message.innerHTML="<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'>Las constraseñas no coinciden o hay un campo vacío </p>";
                return false;
            } 
        break;
        case 'ranking':
            $.ajax({
                url: "../classes/class_user.php",
                type: "post",
                data: {action: "formNew"},
                success: function(htmlResponse){
                    user_rank.innerHTML = htmlResponse;
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
            break;
        default:
            alert('Opción inválida.');
            break;
    }
}