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
                case 'register':
                    $this->register();
                break;
                case 'recoverPwd':
                    $this->recoverPwd();
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
            $captcha = $_REQUEST['captcha'];

            if (!is_numeric($captcha) || $_SESSION['captcha_login'] !== $captcha) 
                header("location: ../login.php?m=x"); // MOSTRAR "CAPTCHA INCORRECTO"

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
                    // $databaseX->getRecord($querySelectUser);
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
            include("../resources/class.phpmailer.php");
            include("../resources/class.smtp.php");

            $cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
            $numeC=strlen($cadena);
            $nuevPWD="";
            for ($i=0; $i<8; $i++){
                $nuevPWD.=$cadena[rand()%$numeC]; 
            }

            $databaseX = new MYSQL_DB();
            // if ( findUserByEmail($_REQUEST['email']) ){
            //     // BREAK O ARROJAR UN MENSAJE DE QUE YA ESTÁ REGISTRADO
            // }
            // BUSCAR QUE EL USUARIO NO ESTÉ REGISTRADO

            $query="insert into usuario set nombre='".$_REQUEST['name']."', apellidos='".$_REQUEST['last_name']."', email='".$_REQUEST['email']."', clave=password('".$nuevPWD."')";

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host="smtp.gmail.com"; 
            // $mail->SMTPSecure = 'tls';
            // $mail->Port = 587;
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port = 465;    
            $mail->SMTPDebug  = 1;  
            $mail->SMTPAuth = true;   
            $mail->Username =   "21030761@itcelaya.edu.mx"; 
            $mail->Password = "jgva azoe wfaf xoyj";  
                
            $mail->From="21030761@itcelaya.edu.mx";
            $mail->FromName="Alfredo";
            $mail->Subject = "Registro completo";
            $mail->MsgHTML("<h1>BIENVENIDO ".$_REQUEST['name']." ".$_REQUEST['last_name']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
            $mail->AddAddress($_REQUEST['email']);
            $mail->AddAddress("admin@admin.com");

            // $databaseX->query($query);
            // header("location: ../register.php?m=8"); 

            echo(var_dump($mail));
            if (!$mail->Send()){
                echo  "Error sending the email: " . $mail->ErrorInfo;
            } else { 
                $databaseX->query($query);
                // $result=mysqli_query($conexion,$query);
                header("location: ../register.php?m=8"); // MSJ: CORREO ENVIADO CORRECTAMENTE
            }
        }

        function recoverPwd(){
            // UPDATE usuario 
        }

        function findUserByEmail ($email_p) : bool{
            $databaseX = new MYSQL_DB();
            $querySelectUser = "select * from usuario where email='{$email_p}'";
            $databaseX->query($querySelectUser);

            if ($databaseX->registersNum == 1){
                return true; // Hacer que siga el flujo 
            }else{
                throw new Exception("User with email ".$email_p." is not register", 400);
            }
        }

        function generateCaptcha($page){
            $operadores = array('+','-','x');

            $operador1 = $operadores[rand(0,2)];
            $operador2 = $operadores[rand(0,2)];

            $num1 = rand(0,9);
            $num2 = rand(0,9);
            $num3 = rand(0,9);

            $res = calculateOperation($num1, $num2, $operador1);
            $res = calculateOperation($res, $num2, $operador2);

            $captcha = $num1 . $operador1 . $num2 . $operador2 . $num3;

            switch ($page) {
                case 'login.php':
                    $_SESSION['captcha_login_res'] = $res;
                    $_SESSION['captcha_login_string'] = $captcha;
                    break;
                case 'register.php':
                    $_SESSION['captcha_register_res'] = $res;
                    $_SESSION['captcha_register_string'] = $captcha;
                case 'password-recover.php':
                    $_SESSION['captcha_password-recover_res'] = $res;
                    $_SESSION['captcha_password-recover_string'] = $captcha;
                default:
                    header("location: ../login.php");
                    break;
            }
        }

        function calculateOperation($numA, $numB, $operador){
            if($operador == "+") return $numA + $numB;
            if($operador == "-") return $numA - $numB;
            return $numA * $numB;
        }
    
    }

    // $databaseX = new MYSQL_DB();

    $newAccess = new Access();
    if(isset($_REQUEST['action'])){
        echo $newAccess->action($_REQUEST['action']);
    }
?>