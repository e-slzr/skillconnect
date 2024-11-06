<link rel="stylesheet" href="css/mistilo.css">
<header>
    <img src="./img/svg/icon-sc-hr.svg" alt="icon-skillconnect" class="d-none d-sm-block" style="height: 35px">

    <!-- icono en moviles -->
    <img src="./img/svg/icon_app.svg" alt="icon-skillconnect" class="d-block d-sm-none" id="login-div-movil" style="height: 35px">
    
    <div class="espaciador"></div>

    <p>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></p>
    <label for="">|</label>
    <a href="crear_perfil.php">Publicar oferta</a>
    <label for="">|</label>
    <a href="logout.php">Cerrar sesión</a>
</header>