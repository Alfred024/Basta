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

            if($email != null && $password != null && $captcha != null){
                if ($_SESSION['captcha_login'] != $captcha){
                    header("location: ../login.php?m=6");
                    return;
                }

                $querySelectUser = "select * from usuario where email='{$email}' and clave='{$password}'";
                $this->query($querySelectUser);
                $this->getRecord($querySelectUser);

                if ($this->registersNum == 1){
                    $data =  $this->getRecord($querySelectUser);
                    $_SESSION['session_email'] = $data->email;
                    $_SESSION['session_password'] = $data->clave;
                    $_SESSION['session_username'] = $data->nombre;

<<<<<<< HEAD
                    if($data->tipo_usuario = '2'){
                        $_SESSION['admin'] = TRUE;
                    }

                    if(!isset($data->foto)){
                        $_SESSION['session_photo'] = '../files/default-user-profile.svg';
                        echo('NO HAY UNA FOTO');
                    }else{
                        
                    }
=======
                    if($data->tipo_usuario === '2'){
                        $_SESSION['admin'] = TRUE;
                    }
>>>>>>> fix2

                    match($data->tipo_usuario){
                        '1' => header("location: ../normal/home.php"),
                        '2' => header("location: ../admin/home.php"),
                        default => header("location: ../normal/home.php")
                    };
                }else{
                    $querySelectUser = "select * from usuario where email='{$email}'";
                    $this->getRecord($querySelectUser);
                    $this->query($querySelectUser);

                    if ($this->registersNum == 1){
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
            $email = $_REQUEST['email'];
            $name = $_REQUEST['name'];
            $last_name = $_REQUEST['last_name'];
            $captcha = $_REQUEST['captcha'];

            if($email != null && $name != null && $last_name != null && $captcha != null){
                if ($_SESSION['captcha_register'] != $captcha){
                    header("location: ../register.php?m=6");
                    return;
                }
                
                if ( $this->isEmailRegistered($email) === true ){
                    header("location: ../register.php?m=2");
                    return;
                }
    
                include("../resources/class.phpmailer.php");
                include("../resources/class.smtp.php");
                
                $passwordGenereated = $this->generatePwd();
                
                $databaseX = new MYSQL_DB();
                $query="insert into usuario set nombre='".$_REQUEST['name']."', apellidos='".$_REQUEST['last_name']."', email='".$_REQUEST['email']."', clave=password('".$passwordGenereated."')";
    
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host="smtp.gmail.com"; 
                $mail->SMTPSecure = 'ssl'; 
                // $PHPMailer->SMTPOptions = array(
                //     'ssl' => array (
                //         'verify_peer' => false,
                //         'verify_peer_name' => false,
                //         'allow_self_signed' => true
                //     )
                // );
                $mail->Port = 465;    
                $mail->SMTPDebug  = 4;  
                $mail->SMTPAuth = true;
                // $mail->Username =   "21030761@itcelaya.edu.mx"; 
                // $mail->Password = "zuji tall oept ngtq";
                $mail->Username =   "alfredo.jimeneztellez9@gmail.com"; 
                $mail->Password = "pbek epkc njxn repo";  
                  
                $mail->From="21030761@itcelaya.edu.mx"; // ???
                $mail->FromName="ADMIN BASTA"; // ???
                $mail->Subject = "Registro de sistema basta completo";
                $mail->MsgHTML("<h1>BIENVENIDO ".$_REQUEST['name']." ".$_REQUEST['last_name']."</h1><h2> tu clave de acceso es : ".$passwordGenereated."</h2>");
                $mail->AddAddress($email); // ???
                // $mail->AddAddress("21030761@itcelaya.edu.mx"); // ???
    
                $databaseX->query($query);
                header("location: ../register.php?m=8"); 
    
                // if (!$mail->Send()){
                //     echo  "Error sending the email: " . $mail->ErrorInfo;
                // } else { 
                //     $databaseX->query($query);
                //     // $result=mysqli_query($conexion,$query);
                //     header("location: ../register.php?m=8"); // MSJ: CORREO ENVIADO CORRECTAMENTE (m=2 de error)
                // }
            }else{
                header("location: ../register.php?m=1");
            }
        }

        function recoverPwd(){
            $email = $_REQUEST['email'];
            $captcha = $_REQUEST['captcha'];

            if($email != null && $captcha != null){
                if ($_SESSION['captcha_recoverPwd'] != $captcha){
                    header("location: ../password-recover.php?m=6");
                    return;
                }

                if($this->isEmailRegistered($email)){
                    // TODO: Genera una nueva contraseña y envía un correo de recuperación
                }else{
                    header("location: ../password-recover.php?m=5"); // No registrado
                }
            }else{
                header("location: ../password-recover.php?m=1");
            }
        }

        // TODO: CREAR ESTOS MÉTODOS COMO HELPERS
        function generatePwd() : string {
            $cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
            $numeC=strlen($cadena);
            $nuevPWD="";
            for ($i=0; $i<8; $i++){
                $nuevPWD.=$cadena[rand()%$numeC]; 
            }
            return $nuevPWD;
        }

        function isEmailRegistered($email_p) : bool{
            $databaseX = new MYSQL_DB();
            $querySelectUser = "select * from usuario where email='{$email_p}'";
            $databaseX->getRecord($querySelectUser);
            $databaseX->query($querySelectUser);

            if ($databaseX->registersNum == 1){
                return true;
            }else{
                return false;
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