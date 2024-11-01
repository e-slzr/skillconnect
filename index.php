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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mistilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <div class="div-titulo">
        <h1 class="titulo">Encuentra Profesionales y Oficios</h1>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Barra de búsqueda con filtros -->
    <form method="GET" action="index.php" class="form-busqueda">
        <input type="text" class="form-control" name="busqueda" placeholder="Buscar por nombre" value="<?php echo $busqueda; ?>">
        <input type="text" class="form-control" name="profesion" placeholder="Profesión/Servicio" value="<?php echo $profesion; ?>">
        <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación" value="<?php echo $ubicacion; ?>">
        <button type="submit" class="btn btn-primary">Buscar</button>
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
