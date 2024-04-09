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
                case 'record':
                
                break;
                case 'pwdForm':
                
                break;
                case 'pwdRecovery':
                
                break;
            }

            return $actionReult;
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
            include("../class.phpmailer.php");
            include("../class.smtp.php");

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

            $cad="insert into usuario set nombre='".$_REQUEST['name']."', apellidos='".$_REQUEST['last_name']."', email='".$_REQUEST['email']."', clave=password('".$nuevPWD."')";

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host="smtp.gmail.com"; //mail.google
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            // $mail->SMTPSecure = 'tls';
            $mail->Port = 465;     // set the SMTP port for the GMAIL server
            // $mail->Port = 587;
            $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;   //enable SMTP authentication
                
            // //  $mail->Username =   "francisco.gutierrez@itcelaya.edu.mx"; // SMTP account username
            // //  $mail->Password = "cosita";  // SMTP account password
            $mail->Username =   "21030761@itcelaya.edu.mx"; // SMTP account username
            $mail->Password = "jgva azoe wfaf xoyj";  // SMTP account password
                
            $mail->From="21030761@itcelaya.edu.mx";
            $mail->FromName="Alfredo";
            $mail->Subject = "Registro completo";
            $mail->MsgHTML("<h1>BIENVENIDO ".$_REQUEST['name']." ".$_REQUEST['last_name']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
            $mail->AddAddress($_REQUEST['email']);
            $mail->AddAddress("admin@admin.com");

            $databaseX->query($cad);
                // $result=mysqli_query($conexion,$cad);
            header("location: ../register.php?m=8"); 

            // echo(var_dump($mail));
            // if (!$mail->Send()){
            //     echo  "Error sending the email: " . $mail->ErrorInfo;
            // } else { 
            //     $databaseX->query($cad);
            //     // $result=mysqli_query($conexion,$cad);
            //     header("location: ../register.php?m=8"); 
            // }
        }

    }

    // var_dump muesytarel contenido de un objeto
    // var_dump($_POST); 
    $newAccess = new Access();
    if(isset($_REQUEST['action'])){
        echo $newAccess->action($_REQUEST['action']);
    }
?>