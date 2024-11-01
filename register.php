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
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="register.php">
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="contrasena" placeholder="contrasena" required>
        <label for="rol">Rol:</label>
        <select name="rol" required>
            <option value="profesional">Profesional</option>
            <option value="usuario">Usuario</option>
        </select>
        
        <button type="submit">Registrar</button>
        <!-- Botón "Cancelar" para regresar al login -->
        <a href="login.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>
