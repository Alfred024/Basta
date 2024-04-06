<?php 
    include "../classes/class_db.php";

    session_start();

    class Access extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formLogin':
                
                break;
                case 'login': 
                    // TODO: Usar método de la API para hacer login
                    $this->login();
                break;
                case 'formRecord':
                
                break;
                case 'record':
                
                break;
                case 'pwdForm':
                
                break;
                case 'pwdRecovery':
                
                break;
            }

            return $actionReult;
        }

        function login() {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            if($email != null && $password != null){
                $databaseX = new MYSQL_DB();
                $querySelectUser = "select * from usuario where email='{$email}' and clave='{$password}'";
                $databaseX->query($querySelectUser);

                if ($databaseX->registersNum == 1){
                    $data =  $databaseX->getRecord($querySelectUser);
                    $_SESSION['session_email'] = $data->email;
                    $_SESSION['session_password'] = $data->clave;
                    $_SESSION['session_username'] = $data->nombre;

                    match($data->tipo_usuario){
                        '1' => header("location: ../normal/home.php"),
                        '2' => header("location: ../admin/home.php"),
                        default => header("location: ../index.php")
                    };
                }else{
                    $querySelectUser = "select * from usuario where email='{$email}'";
                    $databaseX->getRecord($querySelectUser);
                    $databaseX->query($querySelectUser);

                    if ($databaseX->registersNum == 1){
                        header("location: ../login.php?m=2"); // Credenciales incorrectas
                    }else{
                        header("location: ../login.php?m=5"); // No registrado
                    }
                    // 3 correo no exitente (a qué se refiere este error? osea, cuál es la diferencia con el error 5)
                }
            }else{
                header("location: ../login.php?m=1");
            }
        }

        function register() {
            // 4 correos duplicado (Registro)
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            if($email != null && $password != null){
                $databaseX = new MYSQL_DB();
                $querySelectUser = "select * from usuario where email='{$email}' and clave='{$password}'";
                $databaseX->query($querySelectUser);

                if ($databaseX->registersNum == 1){
                    $data =  $databaseX->getRecord($querySelectUser);
                    $_SESSION['session_email'] = $data->email;
                    $_SESSION['session_password'] = $data->clave;

                    match($data->tipo_usuario){
                        '1' => header("location: ../normal/home.php"),
                        '2' => header("location: ../admin/home.php"),
                        default => header("location: ../index.php")
                    };
                }else{
                    // 2 credenciales inválidas

                    // 3 correo no exitente
                    // 4 correos duplicado 
                    // 5 no te hagas, no estás registrado 

                    header("location: ../login.php?m=2");
                }
            }else{
                header("location: ../login.php?m=1");
            }
        }


    }

    // var_dump muesytarel contenido de un objeto
    // var_dump($_POST); 
    $newAccess = new Access();
    if(isset($_REQUEST['action'])){
        echo $newAccess->action($_REQUEST['action']);
    }
?>