<?
//include "classBD.php";
$conexion=mysqli_connect("localhost", "userTEST", '123','test');

$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
$numeC=strlen($cadena);
$nuevPWD="";
for ($i=0; $i<8; $i++)
  $nuevPWD.=$cadena[rand()%$numeC]; 

$cad="insert into usuarios set nombre='".$_REQUEST['nombre']."', apellidos='".$_REQUEST['apellidos']."', correo='".$_REQUEST['correo']."', clave=password('".$nuevPWD."'), fechaUltiAcceso=";


 include("class.phpmailer.php");
 include("class.smtp.php");

$mail = new PHPMailer();
$mail->IsSMTP();
    $mail->Host="smtp.gmail.com"; //mail.google
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Port = 465;     // set the SMTP port for the GMAIL server
    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
                              // 1 = errors and messages
                              // 2 = messages only
    $mail->SMTPAuth = true;   //enable SMTP authentication
    
   //  $mail->Username =   "francisco.gutierrez@itcelaya.edu.mx"; // SMTP account username
   //  $mail->Password = "cosita";  // SMTP account password
   $mail->Username =   "21030761@itcelaya.edu.mx"; // SMTP account username
   $mail->Password = "y32013olbap";  // SMTP account password
      
    $mail->From="21030761@itcelaya.edu.mx";
    $mail->FromName="Alfredo";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO ".$_REQUEST['nombre']." ".$_REQUEST['apellidos']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
    $mail->AddAddress($_REQUEST['correo']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send()){
       echo  "Error: " . $mail->ErrorInfo;
    } else { 
      // Aquí se hace la consulta, pero antes hay que verificar que el correo no esté registrado
      $this->query($cad);
      $result=mysqli_query($conexion,$cad);
      header("location: login.php?m=7"); 
    }
/*

PROBLEMAS A SOLUCIONAR EN EL REGISTRO
1) DETECTAR QUE EL CORREO YA ESTA REGISTRADO, 
   YA QUE ES LA LLAVE PRIMARIA Y NO SE DEBE ENVIAR
   EL CORREO SI YA ESTABA REGISTRADO.
2) LA CLAVE DEBE DE CIFRARSE, POR QUE EN EL 
   LOGUEO SE CIFRA.


*/











?>