<?php
session_start();

//echo($_SESSION['admin']);
if (!isset($_SESSION['admin']) || !isset($_SESSION['session_email'])) {
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
    <link rel="stylesheet" href="https://alfred024.github.io/CSS-mio/styles.css">
    <link rel="stylesheet" href="../styles/global.css">

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
    <script src="../controllers/users.js"></script>
    <script src="../controllers/categories.js"></script>
    <script src="../controllers/tournament.js"></script>
    <script src="../controllers/palabras.js"></script>
    <!-- Custom JS -->
    <script src="../controllers/pop-up-messages.js"></script>
</head>

<body>

    <div class="flex">
        <?php include('./navbar.php') ?>

        <main class="flex-column overflow-auto width-100 height-full">
            <section <?php (isset($user_data) && ($user_data->tipo_usuario == 1 ? "selected" : "")) ?> class="bg-secondary-orange flex justify-between" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <div class="flex">

                    <a class="AsideBar-Anchor text-white anchor-default flex align-center" href="">
                        <span class="List-Item-Span margin-right-10"></span>
                        <li class="margin-block-10" style="list-style: none;">
                            <?php
                                $imagen_path = "../files/profile_pictures/" . $_SESSION['session_id'] . "_" . $_SESSION['session_username'].".jpg";
                                if (!is_file($imagen_path)) {
                                    $imagen_path = "../files/default-user-profile.svg";
                                }
                            ?>
                            <img style="width: 35px;" src="<?php echo $imagen_path; ?>">
                        </li>
                    </a>

                    <h4 class="Page-Title text-white align-self-center margin-left-5">Bienvenido <?= $_SESSION['session_username'] ?></h4>
                </div>

                <button onclick="displayAsideNavBar()" class="Nav-Bar-Toogle-Button bg-bolor-unset border-none margin-right-10 cursor-pointer display-none">
                    <i class="fa-solid fa-bars text-white"></i>
                </button>

            </section>