<?php
session_start();

// Asegurarse de que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nombre_usuario = $_SESSION['nombre'];

include 'config.php';

// Verificamos si hay filtros de búsqueda aplicados
$profesion = isset($_GET['profesion']) ? $_GET['profesion'] : '';
$ubicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : '';
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Consulta de búsqueda con filtros
$query = "SELECT * FROM perfiles WHERE 1=1";
if ($profesion) {
    $query .= " AND profesion LIKE :profesion";
}
if ($ubicacion) {
    $query .= " AND ubicacion LIKE :ubicacion";
}
if ($busqueda) {
    $query .= " AND nombre LIKE :busqueda";
}

$stmt = $conn->prepare($query);
if ($profesion) {
    $stmt->bindValue(':profesion', "%$profesion%");
}
if ($ubicacion) {
    $stmt->bindValue(':ubicacion', "%$ubicacion%");
}
if ($busqueda) {
    $stmt->bindValue(':busqueda', "%$busqueda%");
}
$stmt->execute();
$profesionales = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillConnect | Inicio</title>

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
        <a href="crear_perfil.php">Crear perfil profesional</a>
        <a href=""> | </a>
        <a href="logout.php">Cerrar sesión</a>
    </header>
    <h1>Encuentra Profesionales y Oficios</h1>

    <!-- Barra de búsqueda con filtros -->
    <form method="GET" action="index.php">
        <input type="text" name="busqueda" placeholder="Buscar por nombre" value="<?php echo $busqueda; ?>">
        <input type="text" name="profesion" placeholder="Profesión/Servicio" value="<?php echo $profesion; ?>">
        <input type="text" name="ubicacion" placeholder="Ubicación" value="<?php echo $ubicacion; ?>">
        <button type="submit">Buscar</button>
    </form>

    <!-- Resultados de búsqueda -->
    <h2>Resultados de búsqueda</h2>
    <?php if (empty($profesionales)) : ?>
        <p>No se encontraron resultados.</p>
    <?php else : ?>
        <?php foreach ($profesionales as $profesional) : ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
                <img src="<?php echo $profesional['foto_url']; ?>" alt="Foto de <?php echo $profesional['nombre']; ?>" width="100">
                <h3><?php echo $profesional['nombre']; ?></h3>
                <p>Profesión: <?php echo $profesional['profesion']; ?></p>
                <p>Descripción: <?php echo $profesional['descripcion']; ?></p>
                <p>Ubicación: <?php echo $profesional['ubicacion']; ?></p>
                <p>Honorarios: $<?php echo $profesional['honorarios']; ?></p>
                <p>Teléfono: <?php echo $profesional['telefono']; ?></p>
                <a href="<?php echo $profesional['whatsapp_url']; ?>" target="_blank">Contactar por WhatsApp</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
