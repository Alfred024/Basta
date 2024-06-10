    <link rel="stylesheet" href="../styles/global.css">

    <aside id="Aside-Bar" class="Aside-Bar height-full bg-primary-orange" style="width: 250px;">
        <!-- <h3>AsideBra Basta</h3> -->
        <ul class="text-white" style="margin-top: 30px;">
            <!-- CORREGIR LOS ANCHORS POR LI´s -->

            <a onmouseover="this.style.backgroundColor='lightblue';" onmouseout="this.style.backgroundColor='unset';" class="AsideBar-Anchor AsideBar-Anchor-Selected width-100 text-white anchor-default flex align-center" href="../normal/home.php" style="height: 60px;">
                <span class="List-Item-Span margin-right-10"></span>
                <li class="margin-block-10 width-100">
                    <i class="fa-solid fa-house margin-right-10"></i>
                    Inicio
                </li>
            </a>
            <!-- <a 
                onclick="return users('profile', <?= $_SESSION['session_id'] ?>);" onmouseover="this.style.backgroundColor='lightblue';" onmouseout="this.style.backgroundColor='unset';" class="AsideBar-Anchor width-100 text-white anchor-default flex align-center">
                <span class="List-Item-Span margin-right-10"></span>
                <li class="margin-block-10 width-100">
                    <i class="fa-regular fa-user"></i>
                    Perfil
                </li>
            </a> -->
            <a 
                onclick="return users('profile', 5);" onmouseover="this.style.backgroundColor='lightblue';" onmouseout="this.style.backgroundColor='unset';" class="AsideBar-Anchor width-100 text-white anchor-default flex align-center">
                <span class="List-Item-Span margin-right-10"></span>
                <li class="margin-block-10 width-100">
                    <i class="fa-regular fa-user"></i>
                    Perfil
                </li>
            </a>

            <a onmouseover="this.style.backgroundColor='lightblue';" onmouseout="this.style.backgroundColor='unset';" href="../login.php" class="AsideBar-Anchor width-100 text-white anchor-default flex align-center">
                <span class="List-Item-Span margin-right-10"></span>
                <li class="margin-block-10 width-100">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Cerrar sesión
                </li>
            </a>
        </ul>
    </aside>