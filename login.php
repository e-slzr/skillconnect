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
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="login.php">
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="contrasena" placeholder="contrasena" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    
    <!-- Botón para redirigir a la página de registro -->
    <!-- <p>¿No tienes una cuenta? <a href="registro.php"><button>Regístrate aquí</button></a></p> -->
    <p>¿No tienes una cuenta? <a href="register.php" style="text-decoration: none; color: blue;">Regístrate aquí</a></p>

</body>
</html>
