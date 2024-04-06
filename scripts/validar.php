<?php 
    include "../classes/class_db.php";

    // Recibir variables
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if($email != null && $password != null){
        $databaseX = new MYSQL_DB();
        $querySelectUser = "select * from usuario where email='{$email}' and clave='{$password}'";
        $databaseX->query($querySelectUser);

        if ($databaseX->registersNum == 1){
            print("SÍ HAY ALGO");
        }else{
            // redireccionamiento a x lugar (el param m = 1 es para controlar un msj que se mostrará)
            header("location: ../login.php?m=2");
        }
    }else{
        header("location: ../login.php?m=1");
    }
?>



