<?php
session_start();

//echo($_SESSION['admin']);
if (!isset($_SESSION['session_email'])) {
    header("location: ../login.php?m=2"); // No tienes acceso a esta página sin un login
}

// include '../classes/class_category.php';
// if (isset($_REQUEST['action'])){
//     echo $categoryObject->action($_REQUEST['action']);
// }else{
//     echo $categoryObject->action("report");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home admin</title>

    <!-- STYLES CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://alfred024.github.io/CSS-mio/styles.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/cdb751df44.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script> -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- JQuery confirm -->
    <script src="../controllers/jquery-confirm.js"></script>
    <link rel="stylesheet" href="../styles/jquery-confirm.css">

    <!-- Controller Script -->
    <script src="../controllers/users.js?v=1.0"></script>
    <!-- Custom JS -->
    <script src="../controllers/pop-up-messages.js"></script>
</head>

<body>

    <div class="flex">
        <?php include('./navbar.php') ?>

        <main class="flex-column overflow-auto width-100 height-full">
            <section <?php (isset($user_data) && ($user_data->tipo_usuario == 1 ? "selected" : "")) ?> class="padding-10 bg-secondary-orange flex justify-between" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <div class="flex">
                    <?php
                        $imagen_path = "../files/profile_pictures/" . $_SESSION['session_id'] . "_" . $_SESSION['session_username'] . ".jpg";
                        if (!is_file($imagen_path)) {
                            $imagen_path = "../files/default-user-profile.svg";
                        }
                    ?>
                    <img id="userphoto" style="width: 35px;" src="<?php echo $imagen_path; ?>">

                    <h4 class="Page-Title text-white align-self-center margin-left-5">Bienvenido usuario normal <span id="username"><?= $_SESSION['session_username'] ?></span> </h4>
                </div>


                <div class="search-container">
                    <form action="/action_page.php">
                        <input class="border-none bg-unset padding-5 border-radius-20" type="text" placeholder="Buscador.." name="search">
                        <button class="bg-bolor-unset text-white border-none" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </section>


            <div class="container">
                <div class="row">
                    <div class="col-3 ">

                        <div class="card">
                            <div class="card-header">
                                Ranking
                            </div>
                            <div class="card-body card-1">
                                <!-- <h5 class="card-title" id="rank">Ranking</h5> -->
                                <p class="card-text">Posición actual: <span id="user_rank"></span></p>
                            </div>
                        </div>


                    </div>
                    <div class="col-4 ">

                        <div class="card">
                            <div class="card-header">
                                Estadisticas
                            </div>
                            <div class="card-body card-2">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>



                    </div>
                    <div class="col-5 ">

                        <div class="card">
                            <div class="card-header">
                                Torneos
                            </div>
                            <div class="card-body card-3">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <script>

                $(document).ready(
                    function() {
                        setInterval(() => {
                            users('ranking');
                        }, 3000);
                    }
                );
            </script>