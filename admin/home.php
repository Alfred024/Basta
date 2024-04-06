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
    <title>Home admin</title>
</head>
<body>
    <h1>Bienvenido admin <?= $_SESSION['session_username'] ?> </h1>
</body>
</html>