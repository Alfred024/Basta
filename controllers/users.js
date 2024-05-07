var popUp = '';

function users(action, id) {
    if(typeof(id) === "undefined") id = 0;

    switch (action) {
        case 'formNew':
            
            break;
        case 'insert':
            
            break;
        case 'update':
            
            break;
        case 'delete':
            
            break;
        case 'validateRegister':
            message.innerHTML="";
            if(passw1.value==passw2.value && passw1.value>""){
                return true;
            }else{
                message.innerHTML="La constraseñas no coinciden o hay un campo vacío";
                return false;
            }
            break;
        default:
            alert('Opción inválida.');
            break;
    }
}