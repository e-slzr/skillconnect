<header>
    <img src="./img/svg/icon-sc-hr.svg" alt="icon-skillconnect" class="d-none d-sm-block" style="height: 35px">

    <!-- icono en móviles --> 
    <img src="./img/svg/icon_app.svg" alt="icon-skillconnect" class="d-block d-sm-none" id="login-div-movil" style="height: 35px">
    
    <div class="espaciador"></div>

    <?php if (isset($_SESSION['usuario_id'])): 
        $nombre_usuario = $_SESSION['nombre'];
        ?>
        <!-- Mostrar solo si el usuario está logueado -->
        
        <a href="./miperfil.php">
            <img src="./img/svg/user-man.svg" alt="user-man" class="img-user">
        </a>
        <a href="./miperfil.php">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></a>
        <label for="">|</label>
        
        <!-- Enlace oculto en pantallas móviles -->
        <a href="./postulaciones.php" class="d-none d-sm-inline">Mis postulaciones</a>
        <label for="" class="d-none d-sm-inline">|</label>
        
        <!-- Enlace oculto en pantallas móviles -->
        <a href="./publicar_oferta.php" class="d-none d-sm-inline">Publicar oferta</a>
        <label for="" class="d-none d-sm-inline">|</label>

        <a href="logout.php">Cerrar sesión</a>
    <?php else: ?>
        <!-- Mostrar solo si el usuario no está logueado -->
        <a href="login.php">Iniciar Sesión</a>
        <label for="">|</label>
        <a href="register.php">Registrarse</a>
    <?php endif; ?>
</header>

