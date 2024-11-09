<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header("Location: index.php");
        exit;
    } else {
        echo "Correo o contrasena incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>SkillConnect | Inicio de Sesión</title>
    <link rel="icon" type="image/x-icon" href="img/svg/icon_app.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/miestilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body id="body-login">
    <?php include 'include/preloader.php'; ?>

    <div class="d-none d-sm-block">
        <img src="img/svg/icon-sc-vr.svg" alt="icon-skillconnect" style="padding: 0px 25px">
        <hr class="mb-4">
        <form method="POST" action="login.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary" id="button">Entrar</button>
        </form>
        <hr class="my-3" style="color: white">
        <p style="color: white">¿No tienes una cuenta? <a href="register.php" style="text-decoration: none; color: #5483b3;">Regístrate aquí</a></p>
    </div>

    <!-- Moviles -->
    <div class="d-block d-sm-none" id="login-div-movil">
        <img src="img/svg/icon-sc-vr.svg" alt="icon-skillconnect" style="padding: 0px 25px">
        <hr class="mb-4">
        <form method="POST" action="login.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary" id="button">Entrar</button>
        </form>
        <hr class="my-3" style="color: white">
        <p style="color: white">¿No tienes una cuenta? <a href="register.php" style="text-decoration: none; color: #5483b3;">Regístrate aquí</a></p>
    </div>
</body>
</html>


