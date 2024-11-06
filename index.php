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
    <title>SkillConnect | Bienvenido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mistilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/banner.php'; ?>
    <!-- <?php include 'include/preloader.php'; ?> -->

    <div class="div-titulo">
        <h1 class="titulo">Explora nuevas oportunidades y conecta con quienes buscan tu talento</h1>
    </div>
    

    <!-- Barra de búsqueda/filtros -->
    <button class="btn btn-primary d-block d-sm-none" id="mostrar-filtros">Buscar</button>
    <div class="form-busqueda-contenedor" id="form-busqueda">
        <form method="GET" action="index.php" class="form-busqueda">
            <!-- <input type="text" class="form-control" name="busqueda" placeholder="Buscar por nombre" value="<?php echo $busqueda; ?>"> -->
            <input type="text" class="form-control" name="profesion" placeholder="Profesión/Servicio" value="<?php echo $profesion; ?>">

            <div class="input-group">
                <select class="form-control custom-select">
                    <option selected>Selecciona ubicación</option>
                    <option value="1">Candelaria de la Frontera</option>
                    <option value="2">Chalchuapa</option>
                    <option value="3">Coatepeque</option>
                    <option value="4">El Congo</option>
                    <option value="5">El Porvenir</option>
                    <option value="6">Masahuat</option>
                    <option value="7">Metapán</option>
                    <option value="8">San Antonio Pajonal</option>
                    <option value="9">San Sebastián Salitrillo</option>
                    <option value="10">Santa Ana</option>
                    <option value="11">Santa Rosa Guachipilín</option>
                    <option value="12">Santiago de la Frontera</option>
                    <option value="13">Texistepeque</option>
                </select>
            </div>

            <!-- <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación" value="<?php echo $ubicacion; ?>"> -->
            <button type="submit" class="btn btn-primary" id="miboton">Buscar</button>
        </form>
    </div>
    <!-- finde barra de busqueda/filtros -->

    <hr class="my-3"> <!-- espaciado horizontal -->


    <!-- Resultados de búsqueda -->
    <div class="contenedor-principal">

        <!-- menu desplegable movil -->
        <div class="btn-group dropup d-block d-sm-none mb-3" id="menu-desplegable-contenedor">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" id="menu-desplegable" aria-expanded="false">
                <img src="img/svg/icon-menu.svg" alt="">
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><button class="dropdown-item" type="button">Opcion 1</button></li>
                <li><button class="dropdown-item" type="button">Opcion 2</button></li>
                <li><button class="dropdown-item" type="button">Opcion 3</button></li>
            </ul>
        </div>
        <!-- fin de menu desplegable movil -->

        <div class="resultados">
            <h2>Ofertas de empleo</h2>
            <?php if (empty($profesionales)) : ?>
                <p>No se encontraron resultados.</p>
            <?php else : ?>
                <?php foreach ($profesionales as $profesional) : ?>
                    <div class="div-resultados">
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
        </div>
        <div class="separador-vertical d-none d-sm-block"></div>
        <div class="menu-lateral d-none d-sm-block">
            <!-- <h2>Menu lateral</h2> -->
            
            <ul class="list-group list-group-flush"> 
                <li class="list-group-item" style="border: 1px solid red"><a href="#" class="list-group-link">Quiero ser Premium <img src="img/gif/star-animation.gif" alt="Descripción del GIF" width="30" height="auto"></a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">Últimas ofertas de trabajo!</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">A second item</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">A third item</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">A fourth item</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">And a fifth one</a></li>
            </ul>

        </div>
     </div>
    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<script>
    const toggleButton = document.getElementById('mostrar-filtros');
    const formContainer = document.getElementById('form-busqueda');

    toggleButton.addEventListener('click', () => {
        formContainer.classList.toggle('active'); // Alterna la clase 'active'
        toggleButton.textContent = formContainer.classList.contains('active') ? 'Ocultar' : 'Buscar'; // Cambia el texto del botón
    });
</script>