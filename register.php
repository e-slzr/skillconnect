<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    // Verificar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El correo ya está registrado. Intenta con otro.";
    } else {
        // Encriptar la contrasena
        $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (:nombre, :correo, :contrasena, :rol)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena_hash);
        $stmt->bindParam(':rol', $rol);
        
        // Ejecutar la inserción
        $stmt->execute();

        echo "Registro exitoso. Ahora puedes iniciar sesión.";
        header("Location: login.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>SkillConnect | Registro</title>
    <link rel="icon" type="image/x-icon" href="img/svg/icon_app.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mistilo.css">
</head>
<body id="body-login">
    <?php include 'include/preloader.php'; ?>

    <div class="d-none d-sm-block" id="registro-div">
        <h2 class="titulo">Registro de Usuario</h2><br>
        <form method="POST" action="register.php" onsubmit="return validarContrasena()">
            <div id="error-contrasena">
                Las contraseñas no coinciden. Por favor, inténtalo de nuevo.
            </div>

            <input type="text" name="nombre" placeholder="Nombre completo" class="form-control mb-3" required>
            <input type="email" name="correo" placeholder="Correo electrónico" class="form-control mb-3" required>
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" class="form-control mb-3" required>
            <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar contraseña" class="form-control mb-3" required>

            <div class="div-radios">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1" style="color: white">
                        Profesion
                    </label>
                </div>
                <div class="form-check mb-3 form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2" style="color: white">
                        Oficio
                    </label>
                </div>
            </div>

            <div class="contenedor-button">
                <button type="submit" class="btn btn-primary" id="button">Registrar</button>
                <!-- Botón "Cancelar" para regresar al login -->
                <a href="login.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
            </div>
        </form>
    </div>

    <!-- moviles -->
    <div class="d-block d-sm-none" id="registro-div-movil">
        <h2 class="titulo">Registro de Usuario</h2><br>
        <form method="POST" action="register.php" onsubmit="return validarContrasena()">
            <div id="error-contrasena">
                Las contraseñas no coinciden.
            </div>

            <input type="text" name="nombre" placeholder="Nombre completo" class="form-control mb-3" required>
            <input type="email" name="correo" placeholder="Correo electrónico" class="form-control mb-3" required>
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" class="form-control mb-3" required>
            <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar contraseña" class="form-control mb-3" required>

            <div class="div-radios">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1" style="color: white">
                        Profesion
                    </label>
                </div>
                <div class="form-check mb-3 form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2" style="color: white">
                        Oficio
                    </label>
                </div>
            </div>

            <div class="contenedor-button">
                <button type="submit" class="btn btn-primary" id="button">Registrar</button>
                <!-- Botón "Cancelar" para regresar al login -->
                <a href="login.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
            </div>
        </form>
    </div>
</body>
</html>


<script>
    function validarContrasena() {
        const contrasena = document.getElementById("contrasena").value;
        const confirmarContrasena = document.getElementById("confirmar_contrasena").value;
        const errorContrasena = document.getElementById("error-contrasena");

        if (contrasena !== confirmarContrasena) {
            errorContrasena.style.display = "flex";
            return false; // Evita el envío del formulario
        } else {
            errorContrasena.style.display = "none";
            return true; // Permite el envío del formulario
        }
    }
</script>