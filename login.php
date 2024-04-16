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

  // var_dump($_SESSION);
  echo('RES LOGIN: '.$resLogin);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- STYLES CSS -->
    <link rel="stylesheet" href="https://alfred024.github.io/CSS-mio/styles.css">
    <link rel="stylesheet" href="./styles/global.css">

    <title>Login</title>
</head>

<body>
    <main class="height-100 place-center">
      <!-- <form onsubmit="return false;" method="post" action="./classes/class_access.php" class="mx-auto p-3"> -->
      <form method="post" action="./classes/class_access.php" class="Form padding-10 margin-auto box-shadow-dark flex-column justify-center bg-light-gray border-radius-30" style="width: 420px;">
				<h4 class="width-fit font-weight-600 margin-auto" >Inicio de sesión</h4>
				<hr style="margin: 10px;">

				<label class="flex-column width-80 margin-auto">
					Correo
					<br>
					<input name="email" class="box-shadow-light border-radius-20 padding-10 border-none" type="text" placeholder="juan.montes@itcelaya.edu.mx">
				</label><br>

				<label class="flex-column width-80 margin-auto">
					Contraseña
					<br>
					<input name="password" class="box-shadow-light border-radius-20 padding-10 border-none" type="password" placeholder="">
				</label><br>

        <label class="flex-column width-80 margin-auto">
					Captcha
					<br>
					<input name="captcha" class="box-shadow-light border-radius-20 padding-10 border-none" type="text" placeholder="Favor de resolver la siguiente operación: <?php echo($captchaLogin) ?>">
				</label><br>

        <input type="hidden" name="action" value="login">
				<input class="bg-primary-orange text-white border-radius-20 padding-10 border-none margin-auto" type="submit" value="Iniciar sesión" style="width: 200px;">

        <?php 
          if (isset($_GET['m'])) {
            $estado = $_GET['m'];
            switch ($estado) {
              case 1:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> Llene cada uno de los campos.</h5>");
                break;
              case 2:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> Credenciales inválidas.</h5>");
                break;
              case 5:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> No te hagas, no estás registrado.</h5>");
                break;
              case 6:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 15px; color: orangered;'> Por favor, compruebe el campo del captcha.</h5>");
                break;
            }
          }
        ?>

				<div class="flex center-flex-xy margin-top-10">
					<span class="font-size-15 margin-right-5">¿Aún no tienes cuenta?</span>
					<a href="./register.php" class="Anchor-Form anchor-default font-size-15 text-secondary-blue font-weight-600">Crea una aquí</a>
				</div>
			</form>
    </main>
</body>
</html>

