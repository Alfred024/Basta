<?php 
  session_start();
  session_destroy();
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
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa el Captcha">
        </div> 

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
            }
          }
        ?>
        
        <input type="hidden" name="action" value="login">
        <button type="submit" class="btn btn-primary mt-5">Iniciar sesión</button>
      </form>
    </main>
</body>
</html>

