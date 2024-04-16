<?php
  session_start();
  session_unset();

  function getCaptcha(&$res){
    $operadores = array('+','-','x');
    //$operadores = "+-x";

    $operador1 = $operadores[rand(0,2)];
    $operador2 = $operadores[rand(0,2)];

    $num1 = rand(0,9);
    $num2 = rand(0,9);
    $num3 = rand(0,9);

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

  var_dump($_SESSION);
  echo('RES PWD RECOVER: '.$resRecoverPwd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./STYLE/bootstrap-copy.css">
    <title>Document</title>
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

      <form method="post" class="mx-auto w-50 p-3">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="210243@itcelaya.edu.mx">
        </div>


        <div class="form-group">
          <label for="exampleInputEmail1">Captcha</label>
          <input name="captcha" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Favor de resolver la siguiente operación: <?php echo($captchaRecoverPwd) ?>">
        </div> 

        <input type="hidden" name="action" value="recoverPwd">
        <button type="submit" class="btn btn-primary">Recuperar contraseña</button>

        <!-- Mensajes de error del server -->
        <?php 
          if (isset($_GET['m'])) {
            $estado = $_GET['m'];
            switch ($estado) {
              case 1:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> Llene cada uno de los campos.</h5>");
                break;
              case 5:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> No te hagas, no estás registrado.</h5>");
                break;
              case 6:
                  echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'> Por favor, compruebe el campo del captcha.</h5>");
                break;
              case 8:
                echo("<h5 style='margin-top: 10px; font-weight: bold; text-align: end; font-size: 18px; color: red;'>Verifique su correo para obtener su nueva clave</h5>");
              break;
            }
          }
        ?>
      </form>
    </main>
</body>
</html>