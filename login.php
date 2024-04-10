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

    <link rel="stylesheet" href="./STYLE/bootstrap-copy.css">
    <link rel="stylesheet" href="./STYLE/style.css">
    <title>Registro</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                  <a class="nav-link" href="./login.php">Inicio de sesión</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="./register.php">Registro</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="./password-recover.php">Recuperar contraseña</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="./about-us.php">Sobre nosotros</a>
                  </li>
              </ul>
             
            </div>
          </nav>
    </header>

    <main>

      <!-- <form onsubmit="return false;" method="post" action="./classes/class_access.php" class="mx-auto p-3"> -->
      <form  method="post" action="./classes/class_access.php" class="mx-auto p-3">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa el EMAIL">
        </div>


        <div class="form-group">
          <label for="exampleInputPassword1">Contraseña</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresa la contraseña">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Captcha</label>
          <input name="captcha" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Favor de resolver la siguiente operación: <?php echo($captchaLogin) ?>">
        </div> 

        <!-- Mensajes de error del server -->
        <?php 
          if (isset($_GET['m'])) {
            $estado = $_GET['m'];
            switch ($estado) {
              case 1:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> Llene cada uno de los campos.</h5>");
                break;
              case 2:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> Credenciales inválidas.</h5>");
                break;
              case 5:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> No te hagas, no estás registrado.</h5>");
                break;
              case 6:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> Por favor, compruebe el campo del captcha.</h5>");
                break;
            }
          }
        ?>
        
        <input type="hidden" name="action" value="login">
        <button type="submit" class="btn btn-primary mt-5">Iniciar sesión</button>
      </form>
    </main>
</body>
</html>

