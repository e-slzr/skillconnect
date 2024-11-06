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
    <title>SkillConnect | Publicar oferta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mistilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/carrusel.php'; ?>

    <h2 style="text-align: center; margin: 20px 0px">Nueva oferta</h2>
    <div class="contenedor-oferta">
        <form method="POST" action="crear_perfil.php" class="form-control mb-3">
            <input type="text" name="nombre" placeholder="Nombre del puesto" class="form-control mb-3" required>
            <div class="">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Profesion
                    </label>
                </div>
                <div class="form-check mb-3 form-check-inline">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Oficio
                    </label>
                </div>
            </div>
            <textarea name="descripcion" placeholder="Descripción del servicio" class="form-control mb-3" required ></textarea>
            <div class="input-group">
                <span class="input-group-text mb-3" id="basic-addon1">$</span>
                <input type="number" step="0.01" name="honorarios" placeholder="Sueldo (USD)" class="form-control mb-3" required>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
                <input type="email" name="email" placeholder="Correo de contacto" class="form-control" required>
            </div>
            <input type="text" name="ubicacion" placeholder="Departamento" class="form-control mb-3" required>
            <input type="tel" name="telefono" placeholder="Contacto de WhatsApp" class="form-control mb-3">
            <div class="contenedor-button">
                <button type="submit" class="btn btn-primary" id="miboton">Publicar oferta</button>
                <a href="index.php"><button type="button" 
                class="btn btn-danger">Cancelar</button></a>
            </div>
            
        </form>
    </div>
</body>
</html>
