<!--
Genración de id de sesión
    ip
    sistema operativo
    nombre navegador
    id de la pestaña del navegador
-->
<!-- 
1 llene cada uno de los campos
2 credenciales inválidas
3 correo no exitente
4 correos duplicado 
5 no te hagas, no estás registrado 
-->
<?php 
    session_start();
    
    if(!isset($_SESSION['session_email'])){
        header("location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo("<h1>BIENVENIDO</h1>");
    ?>

    <a href="./login.php">Cerrar sesión</a>
</body>
</html>