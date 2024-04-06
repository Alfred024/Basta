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
                    $_SESSION['session_password'] = $data->password;

                    header("location: ../home.php");
                }else{
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