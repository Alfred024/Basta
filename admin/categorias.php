<!-- SE MANDA A LLAMAR CON EL BOTÓN DEL NAVBAR -->
<?php 
    session_start();
    
    // if(!isset($_SESSION['session_email']) || $_SESSION['admin'] !== TRUE){
    //     header("location: ./login.php");
    // }

    // include 'barra.php';
    include '../classes/class_category.php';

    if ($_REQUEST['action']){
        echo $categoryObject->action($_REQUEST['action']);
    }
?>