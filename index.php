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

// Consulta de búsqueda con filtros, incluyendo nombre del usuario que publicó la oferta
$query = "SELECT o.*, u.nombre AS nombre_usuario FROM ofertas o JOIN usuarios u ON o.usuario_id = u.id WHERE 1=1";
if ($profesion) {
    $query .= " AND o.profesion LIKE :profesion";
}
if ($ubicacion) {
    $query .= " AND o.ubicacion LIKE :ubicacion";
}
if ($busqueda) {
    $query .= " AND o.nombre LIKE :busqueda";
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

// Función para limitar la descripción a 20 palabras
function limitarDescripcion($texto, $limitePalabras = 20) {
    $palabras = explode(' ', $texto);
    if (count($palabras) > $limitePalabras) {
        return implode(' ', array_slice($palabras, 0, $limitePalabras)) . '...';
    }
    return $texto;
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillConnect | Bienvenido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/miestilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/banner.php'; ?>
    <?php include 'include/preloader.php'; ?>

    <div class="div-titulo">
        <h1 class="titulo">Explora nuevas oportunidades y conecta con quienes buscan tu talento</h1>
    </div>

    
    <!-- Barra de búsqueda/filtros -->
    <button class="btn btn-primary d-block d-sm-none mb-3" id="mostrar-filtros">Buscar</button>
    <div class="form-busqueda-contenedor" id="form-busqueda">
        <form method="GET" action="index.php" class="form-busqueda">
            <!-- Campo de búsqueda por nombre -->
            <input type="text" class="form-control mb-3" name="busqueda_nombre" placeholder="Busca por nombre" value="">

            <!-- Selector de ubicación -->
            <div class="input-group mb-3">
                <select class="form-control custom-select" name="ubicacion">
                    <option selected value="">Todas las ubicaciones</option>
                    <option value="Candelaria de la Frontera">Candelaria de la Frontera</option>
                    <option value="Chalchuapa">Chalchuapa</option>
                    <option value="Coatepeque">Coatepeque</option>
                    <option value="El Congo">El Congo</option>
                    <option value="El Porvenir">El Porvenir</option>
                    <option value="Masahuat">Masahuat</option>
                    <option value="Metapan">Metapán</option>
                    <option value="San Antonio Pajonal">San Antonio Pajonal</option>
                    <option value="San Sebastián Salitrillo">San Sebastián Salitrillo</option>
                    <option value="Santa Ana">Santa Ana</option>
                    <option value="Santa Rosa Guachipilín">Santa Rosa Guachipilín</option>
                    <option value="Santiago de la Frontera">Santiago de la Frontera</option>
                    <option value="Texistepeque">Texistepeque</option>
                </select>
            </div>

            <!-- Selector de profesión/categoría -->
            <div class="input-group mb-3">
                <select class="form-control custom-select" name="profesion">
                    <option selected value="">Todas las categorías</option>
                    <option value="Profesión">Profesiones</option>
                    <option value="Oficio">Oficios</option>
                    <option value="Pasantía">Pasantías</option>
                </select>
            </div>
            <button type="submit" class="btn" id="miboton">Buscar</button>
        </form>
    </div>
    <!-- finde barra de busqueda/filtros -->
    <hr class="my-3"> <!-- Espaciado horizontal -->

    <!-- Resultados de búsqueda -->
    <div class="contenedor-principal">
        <div class="resultados">
            <h2 style="width: 100%; max-height: 70px">Ofertas de empleo</h2>
            <?php if (empty($profesionales)) : ?>
                <p style="font-size: 30pt"><strong>No se encontraron resultados.</strong></p>
            <?php else : ?>
                <?php foreach ($profesionales as $profesional) : ?>
                    <div class="div-resultados">
                        <div class="icono-company">
                            <img src="./img/svg/icon_app.svg" alt="Imagen empresa">
                        </div>
                        <h3><strong><?php echo $profesional['nombre']; ?></strong></h3>
                        <p class="info-oferta"><strong>Categoría: </strong><?php echo $profesional['profesion']; ?></p>
                        <p class="info-oferta"><strong>Descripción: </strong><?php echo limitarDescripcion($profesional['descripcion']); ?></p>
                        <p class="info-oferta"><strong>Ubicación: </strong><?php echo $profesional['ubicacion']; ?></p>
                        <p class="info-oferta"><strong>Sueldo: </strong>$<?php echo $profesional['sueldo']; ?></p>
                        <p class="info-oferta"><strong>Teléfono: </strong><?php echo $profesional['telefono']; ?></p>
                        <p class="info-oferta" style="color: #578640"><strong>Publicado por: </strong><?php echo $profesional['nombre_usuario']; ?></p>
                        <p class="info-oferta" style="color: #5483b3"><a href="">Saber más...</a></p>
                        
                        <!-- Botones de tarjetas (Aplicar/Whatsapp) -->
                        <div class="info-contenedor-btn">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalAplicar">Aplicar</button>
                            <a href="https://wa.me/503<?php echo str_replace('-', '', $profesional['telefono']); ?>" target="_blank">
                                <div class="info-oferta-contacto btn btn-primary">
                                <img src="./img/svg/ico-wsp-white.svg" alt="ico-wsp">
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Código de modal de aplicación y menú lateral -->
        <!-- Vertically centered modal -->
        <div class="modal" tabindex="-1" id="miModalAplicar">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sube tu hoja de vida</h5>
                </div>
                <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="boton-cerrar">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="miboton1">Enviar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Alerta personalizada -->
        <div class="" id="alertaAplicacion">
            <div>
                <strong>¡ENHORABUENA!</strong>
                <br>
                Has aplicado a esta oferta de trabajo.<br>
                <img src="img/gif/ok-animation.gif" alt="Descripción del GIF" width="50" height="auto">
            </div>
        </div>
        <!-- JavaScript para el botón "Enviar" -->
        <script>
        document.getElementById('miboton1').addEventListener('click', function() {
            // Mostrar alerta personalizada
            var alerta = document.getElementById('alertaAplicacion');
            alerta.style.display = 'flex';

            // Cerrar la alerta después de 2 segundos
            setTimeout(function() {
            alerta.style.display = 'none';
            }, 3000); // 3000 ms = 3 segundos

            // Cerrar el modal después de mostrar la alerta
            var modal = bootstrap.Modal.getInstance(document.getElementById('miModalAplicar'));
            modal.hide();
        });
        </script>
        <!-- Menu lateral -->
        <?php include 'include/menu_lateral.php'; ?>
    </div>
    
    <?php include 'include/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<script>
    const toggleButton = document.getElementById('mostrar-filtros');
    const formContainer = document.getElementById('form-busqueda');
    toggleButton.addEventListener('click', () => {
        formContainer.classList.toggle('active'); 
        toggleButton.textContent = formContainer.classList.contains('active') ? 'Ocultar' : 'Buscar'; 
    });
</script>
