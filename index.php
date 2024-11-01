<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT id, contraseña FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: index.php");
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
</head>
<body>
    <form method="POST" action="login.php">
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
