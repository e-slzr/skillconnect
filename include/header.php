<header>
    <img src="./img/svg/icon-sc-hr.svg" alt="icon-skillconnect" class="d-none d-sm-block" style="height: 35px">

    <!-- icono en moviles --> 
    <img src="./img/svg/icon_app.svg" alt="icon-skillconnect" class="d-block d-sm-none" id="login-div-movil" style="height: 35px">
    
    <div class="espaciador"></div>
    <a href="./miperfil.php">
        <img src="./img/svg/user-man.svg" alt="user-man" class="img-user">
    </a>
    <a href="./miperfil.php">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></a>
    <label for="">|</label>
    <a href="./postulaciones.php">Mis postulaciones</a>
    <label for="">|</label>
    <a href="./publicar_oferta.php">Publicar oferta</a>
    <label for="">|</label>
    <a href="logout.php">Cerrar sesión</a>
</header>