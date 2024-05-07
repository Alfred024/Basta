<?php
    session_start();

    //echo($_SESSION['admin']);
    if (!isset($_SESSION['admin'])) {
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
    <script
      src="https://kit.fontawesome.com/cdb751df44.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>

    <div class="flex">   
        <?php include('./navbar.php') ?>

        <main class="flex-column overflow-auto width-100 height-full">
            <section class="padding-10 bg-secondary-orange flex justify-between" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <div class="flex">
                    <img class="margin-right-10" src="https://www.svgrepo.com/show/295402/user-profile.svg" alt="User profile picture" style="width: 35px;">

                    <h4 class="Page-Title text-white align-self-center margin-left-5">Bienvenido admin <?= $_SESSION['session_username'] ?></h4>
                </div>
                
                <button onclick="displayAsideNavBar()" class="Nav-Bar-Toogle-Button bg-bolor-unset border-none margin-right-10 cursor-pointer display-none">
                    <i class="fa-solid fa-bars text-white"></i>
                </button>
            </section>

            <?php 
                include '../classes/class_category.php';
            ?>
        </main>
    </div>

    <!-- <script>
        // Manejar el display del asideBar
        var asideBar = document.getElementById('Aside-Bar');
        var mediaQuery = window.matchMedia('(min-width: 750px)');
        var handleMediaQueryChange = function(mediaQuery) {
            if (mediaQuery.matches) {
                asideBar.style.display = 'block';
            } else {
                asideBar.style.display = 'none';
            }
        };
        mediaQuery.addListener(handleMediaQueryChange);

        function displayAsideNavBar(){
            var asideBar = document.getElementById('Aside-Bar');
            if(asideBar.style.display === 'block'){
                asideBar.style.display = 'none';
            }else{
                asideBar.style.display = 'block';
            }
        }
    </script>  -->
</body>
</html>