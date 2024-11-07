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
    <?php include 'include/preloader.php'; ?>

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
                <select class="form-control custom-select" name="ubicacion">
                    <option selected value="">Selecciona ubicación</option>
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
                    <option value="1Santa Rosa Guachipilín1">Santa Rosa Guachipilín</option>
                    <option value="Santiago de la Frontera">Santiago de la Frontera</option>
                    <option value="Texistepeque">Texistepeque</option>
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
            <h2 style="width: 100%; max-height: 70px">Ofertas de empleo</h2>
            <?php if (empty($profesionales)) : ?>
                <p style="font-size: 30pt"><strong>No se encontraron resultados.</strong></p>

            <!-- Tarjeta de oferta de empleo -->
            <?php else : ?>
                <?php foreach ($profesionales as $profesional) : ?>
                    <div class="div-resultados">
                        <div class="icono-company">
                            <img src="./img/svg/ico-company.svg" alt="Imagen empresa">
                        </div>
                        <h3><strong><?php echo $profesional['nombre']; ?></strong></h3>
                        <!-- <p>Profesión: <?php echo $profesional['profesion']; ?></p> -->
                        <p class="info-oferta"><strong>Descripción: </strong><?php echo $profesional['descripcion']; ?></p>
                        <p class="info-oferta"><strong>Ubicación: </strong><?php echo $profesional['ubicacion']; ?></p>
                        <p class="info-oferta"><strong>Sueldo: </strong>$<?php echo $profesional['honorarios']; ?></p>
                        <p class="info-oferta"><strong>Teléfono: </strong><?php echo $profesional['telefono']; ?></p>
                        <p class="info-oferta" style="color: #578640"><strong>Publicado por: </strong>SkillConnect Company</p>
                        <p class="info-oferta" style="color: #5483b3"><a href="">Saber más...</a></p>
                        <div class="info-contenedor-btn">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModalAplicar">Aplicar</button>

                         

                            <div class="info-oferta-contacto btn btn-primary">
                                <a href="https://wa.link/v4qi3y" target="_blank"><img src="./img/svg/ico-wsp-white.svg" alt="ico-wsp"> | Más información</a>
                            </div>
                        </div>
                    </div>
                    
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- Fin de tarjeta -->

               
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

        </div>
        <div class="separador-vertical d-none d-sm-block"></div>
        <div class="menu-lateral d-none d-sm-block">
            <!-- <h2>Menu lateral</h2> -->
            <ul class="list-group list-group-flush"> 
                <li class="list-group-item"><a href="#" class="list-group-link">Quiero ser Premium <img src="img/gif/star-animation.gif" alt="Descripción del GIF" width="30" height="auto"></a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">Últimas ofertas de trabajo!</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">¿Como hacer mi CV?</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">Plataformas de aprendizajes</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">Sobre SkillConnect</a></li>
                <li class="list-group-item"><a href="#" class="list-group-link">Ayuda</a></li>
            </ul>
        </div>
     </div>
    
     <?php include 'include/footer.php'; ?>

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