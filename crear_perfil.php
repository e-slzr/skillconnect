<?php
session_start();

// Asegurarse de que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nombre_usuario = $_SESSION['nombre'];

include 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $_POST['nombre'];
    $profesion = $_POST['profesion'];
    $descripcion = $_POST['descripcion'];
    $honorarios = $_POST['honorarios'];
    $telefono = $_POST['telefono'];
    $ubicacion = $_POST['ubicacion'];
    $whatsapp_url = $_POST['whatsapp_url'];
    $foto_url = 'ruta_de_la_foto.jpg';  // Puedes actualizar esto para subir una foto

    $stmt = $conn->prepare("INSERT INTO perfiles (usuario_id, nombre, profesion, descripcion, honorarios, telefono, ubicacion, whatsapp_url, foto_url) VALUES (:usuario_id, :nombre, :profesion, :descripcion, :honorarios, :telefono, :ubicacion, :whatsapp_url, :foto_url)");
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':profesion', $profesion);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':honorarios', $honorarios);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':whatsapp_url', $whatsapp_url);
    $stmt->bindParam(':foto_url', $foto_url);
    $stmt->execute();

    echo "Perfil creado exitosamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillConnect | Crear perfil</title>

    <style>
        /* Estilos básicos para el encabezado */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #042254;
        }
        header p {
            color: #ffffff;
            margin: 0;
        }
        header a {
            text-decoration: none;
            color: #ffffff;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<header>
        <p>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></p>
        <a href="logout.php">Cerrar sesión</a>
    </header>
    <h2>Crear Perfil Profesional</h2>
    <form method="POST" action="crear_perfil.php">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="profesion" placeholder="Profesión/Servicio" required>
        <textarea name="descripcion" placeholder="Descripción del servicio" required></textarea>
        <input type="number" step="0.01" name="honorarios" placeholder="Honorarios (USD)" required>
        <input type="tel" name="telefono" placeholder="Teléfono de contacto" required>
        <input type="text" name="ubicacion" placeholder="Ubicación" required>
        <input type="text" name="whatsapp_url" placeholder="Enlace de WhatsApp">
        <button type="submit">Crear Perfil</button>
        <a href="index.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>
