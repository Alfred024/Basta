<?php
  session_start();
  session_unset();

  function getCaptcha(&$res){
    $operadores = array('+','-','x');
    //$operadores = "+-x";

    $operador1 = $operadores[rand(0,2)];
    $operador2 = $operadores[rand(0,2)];

    $num1 = rand(1,7);
    $num2 = rand(1,7);
    $num3 = rand(1,7);

    $res = calculateOperation($num1, $num2, $operador1);
    $res = calculateOperation($res, $num2, $operador2);

    $captcha = $num1 . $operador1 . $num2 . $operador2 . $num3;
    return $captcha;
  }

  function calculateOperation($numA, $numB, $operador){
    if($operador == "+") return $numA + $numB;
    if($operador == "-") return $numA - $numB;
    return $numA * $numB;
  }


  $resLogin=$resRegister=$resRecoverPwd = 0;

  $captchaLogin = getCaptcha($resLogin);
  $captchaRegister = getCaptcha($resRegister);
  $captchaRecoverPwd = getCaptcha($resRecoverPwd);

  $_SESSION['captcha_login'] = $resLogin;
  $_SESSION['captcha_register'] = $resRegister;
  $_SESSION['captcha_recoverPwd'] = $resRecoverPwd;

  //var_dump($_SESSION);
  echo('RES REGISTER: '.$resRegister);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- STYLES CSS -->
    <link rel="stylesheet" href="https://alfred024.github.io/CSS-mio/styles.css">
    <link rel="stylesheet" href="./styles/global.css">

    <!-- JS -->
    <!-- Para qué era el ?2024.01 ??? -->
    <!-- <script src="./controllers/users.js?2024.01"></script> --> 

    <script src="./controllers/users.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Ajax -->
    
</head>

<body>
    <main class="height-100 place-center">

    <form id="form_register" method="post" action="./classes/class_access.php" class="Form padding-10 margin-auto box-shadow-dark flex-column justify-center bg-light-gray border-radius-30" style="width: 420px;">
				<h4 class="width-fit font-weight-600 margin-auto" >Registro</h4>
				<hr style="margin: 10px;">

        <label class="flex-column width-80 margin-auto">
					Nombre
					<br>
					<input name="name" class="box-shadow-light border-radius-20 padding-5 border-none" type="text">
				</label><br>

        <label class="flex-column width-80 margin-auto">
					Apellido
					<br>
					<input name="last_name" class="box-shadow-light border-radius-20 padding-5 border-none" type="text">
				</label><br>
				
        <label class="flex-column width-80 margin-auto">
					Correo
					<br>
					<input name="email" class="box-shadow-light border-radius-20 padding-5 border-none" type="text" placeholder="juan.montes@itcelaya.edu.mx">
				</label><br>

        <label class="flex-column width-80 margin-auto">
					Contraseña
					<br>
					<input name="passw1" id="passw1" class="box-shadow-light border-radius-20 padding-5 border-none" type="password">
				</label><br>
				
        <label class="flex-column width-80 margin-auto">
          Confirmación de contraseña
					<br>
					<input name="passw2" id="passw2" class="box-shadow-light border-radius-20 padding-5 border-none" type="password">
				</label><br>

        <div class="flex margin-auto margin-bottom-10 width-80">
          <div class="flex">
            <input type="radio" name="maleGender" id="flexRadioDefault1" checked>
            <label class="form-check-label margin-right-10" for="flexRadioDefault1">
              Mujer
            </label>
          </div>
          <div class="flex">
            <input type="radio" name="maleGender" id="flexRadioDefault1">
            <label class="form-check-label margin-right-10" for="flexRadioDefault1">
              Hombre
            </label>
          </div>
        </div>

        <label class="flex-column width-80 margin-auto">
					Captcha
					<br>
					<input name="captcha" class="box-shadow-light border-radius-20 padding-5 border-none" type="text" placeholder="Favor de resolver la siguiente operación: <?php echo($captchaRegister) ?>">
				</label><br>

        <input type="hidden" name="action" value="register">
				<!-- <input class="bg-primary-orange text-white border-radius-20 padding-5 border-none margin-auto" type="submit" value="Registrar datos" style="width: 200px;"> -->
        <input 
          class="bg-primary-orange text-white border-radius-20 padding-5 border-none margin-auto" 
          type="submit" 
          onclick="return users('validateRegister')" 
          value="Registrar (js)" style="width: 200px;">
        <span id="message"></span>


        <!-- TODO: CREAR UNA CLASE Y HACER UN INCLUDE -->
        <?php 
          if (isset($_GET['m'])) {
            $estado = $_GET['m'];
            switch ($estado) {
              case 1:
                  echo("<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> Llene cada uno de los campos.</p>");
                break;
              case 2:
                  echo("<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> El email proporcionado ya se encuentra registrado.</p>");
                break;
              case 6:
                  echo("<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> Por favor, compruebe el campo del captcha.</p>");
                break;
              case 7:
                  echo("<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> No se pudo enviar el correo.</p>");
                break;
              case 8:
                  echo("<p style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: forestgreen;'> Su registro se completó exitosamente. Verifique su correo para obtener su clave.</p>");
                break;
            }
          }
        ?>

				<div class="flex center-flex-xy margin-top-10">
					<span class="font-size-15 margin-right-5">¿Ya tienes una cuenta?</span>
					<a href="./login.php" class="Anchor-Form anchor-default font-size-15 text-secondary-blue font-weight-600">Ingresa aquí</a>
				</div>
			</form>

    </main>
</body>
</html>