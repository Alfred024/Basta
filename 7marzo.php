<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- STYLES CSS -->
    <link rel="stylesheet" href="https://alfred024.github.io/CSS-mio/styles.css">
    <link rel="stylesheet" href="./styles/global.css">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function registra() {
            $.ajax({
                url: "http://172.20.105.1/pw2024_1/pruebaAJAX.php",
                data: {accion: "registra", comentario: comments.value},
                type: "post",
                beforeSend: function(){ message.innerHTML="Loading..." },
                success: function(response){
                    console.log('Comentario registrado');
                    message.innerHTML=""
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
        }
        function revisa() {
            $.ajax({
                url: "http://172.20.105.1/pw2024_1/pruebaAJAX.php",
                data: {accion: "revisa"},
                type: "post",
                beforeSend: function(){ message.innerHTML="Loading..." },
                success: function(response){
                    resJSON = JSON.parse(response);
                    console.log(resJSON);
                    // resHTML = '<table class="Table overflow-x-auto padding-10 width-100 border-radius-20">';
                    // resHTML += '<thead><tr> <thead><tr> ';

                    // for (let index = 0; index < resJSON.length; index++) {
                    //     resHTML += `<p class="" >${resJSON[index].Comentario}</p>`;
                    // }

                    // resHTML += '</table>';
                    

                    // message.innerHTML = response; 
                },
                error: function(err){ console.log(JSON.stringify(err)); },
            });
        }
    </script>
</head>
<body>
    
    <div class="flex-column margin-auto border-radius-10 width-50">
        <textarea name="" id="comments"></textarea>
        <div>
            <button onclick="registra()" class="margin-auto border-none border-radius-10 bg-primary-blue padding-10 text-white">Enviar</button>
        </div>
        <span id="message"></span>
    </div>



    <script>
        // setInterval(revisa, 1000);
    </script>
</body>
</html>