<?php
    session_start();
    include 'config.php'; // Archivo de configuración de conexión a la base de datos

    // Asegúrate de que el usuario esté autenticado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php"); // Redirige al login si no está autenticado
        exit;
    }

    $usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario desde la sesión

    try {
        // Preparar la consulta para obtener los datos del usuario
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los datos del usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Aquí puedes acceder a los datos del usuario
            $nombre = $usuario['nombre'];
            $dui = $usuario['dui'];
            $correo = $usuario['correo'];
            $profesion = $usuario['profesion'];
            $telefono = $usuario['telefono'];
            $direccion = $usuario['direccion'];
            $about = $usuario['about'];
            $rol = $usuario['rol'];
            $nombre_usuario = $usuario['nombre'];
            // Otros datos que tengas en la tabla `usuarios`
        } else {
            echo "Usuario no encontrado.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
include 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillConnect | Mi perfil</title>
    <link rel="icon" type="image/x-icon" href="img/svg/icon_app.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/miestilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/preloader.php'; ?>

    <div class="contenedor-perfil">
        <div class="div-perfil">
            <div class="div-perfil-izq">
                <h2><strong>Mi perfíl</strong></h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Foto de perfil<br>
                        <img src="./img/svg/user-man.svg" alt=""></strong>
                        <a href="">Editar foto de perfil</a>
                    </li>
                    <li class="list-group-item"><strong>Profesión/Oficio: </strong><input class="form-control" value="<?php echo $profesion?>" readonly></li>
                    <li class="list-group-item"><strong>Nombre: </strong><input class="form-control" value="<?php echo $nombre?>" readonly></li>
                    <li class="list-group-item"><strong>DUI: </strong><input class="form-control" value="<?php echo $dui?>" readonly></li>
                    <li class="list-group-item"><strong>Dirección: </strong><input class="form-control" value="<?php echo $direccion ?>" readonly></li>
                    <li class="list-group-item"><strong>Correo: </strong><input class="form-control" value="<?php echo $correo?>" readonly></li>
                    <li class="list-group-item"><strong>Teléfono: </strong><input class="form-control" value="<?php echo $telefono ?>" readonly></li>
                    <li class="list-group-item">
                        <strong>Sobre mi:<br></strong>
                        <textarea name="" id="" class="form-control" rows="4" value="" readonly><?php echo $about ?></textarea>
                    </li>
                    <li class="list-group-item"><strong>Tipo de perfil: </strong><input class="form-control" value="<?php echo $rol ?>" readonly></li>
                </ul>
                <div class="perfil-contenedor-btn">
                    <button class="btn btn-primary" id="miboton">Editar perfil</button>
                </div>
            </div>

            <!-- Include de menu lateral -->
            <?php include 'include/menu_lateral.php'; ?>
        </div>    
    </div>
</body>

<?php include 'include/footer.php'; ?>
</html>