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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillConnect | Mi perfil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/miestilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/banner.php'; ?>
    <?php include 'include/preloader.php'; ?>
    <div class="contenedor-postulaciones">
        <div class="div-perfil">
            <div class="div-perfil-izq">
                <h2><strong>Mis postulaciones (3)</strong></h2>
                <ul class="lista-postulaciones">
                    <li class="list-group-item">
                        <div class="postulacion">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <strong>&nbsp;1. Auxiliar contable (Pasantia remunerada)</strong>&nbsp;|&nbsp;
                            <div class="info-postulacion">
                                <strong class="info-postulacion">Categoria: </strong>Pasantia&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Publicado por: </strong> SkillConnect&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Aplicado el:</strong> &nbsp;10 de Nov de 2024
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="postulacion">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <strong>&nbsp;2. Docente de Matemáticas (Bachillerato)</strong>&nbsp;|&nbsp;
                            <div class="info-postulacion">
                                <strong class="info-postulacion">Categoria: </strong>Profesion&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Publicado por: </strong> SkillConnect&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Aplicado el:</strong> &nbsp;10 de Nov de 2024
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="postulacion">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <strong>&nbsp;3. Albañil (Proyecto de 6 meses)</strong>&nbsp;|&nbsp;
                            <div class="info-postulacion">
                                <strong class="info-postulacion">Categoria: </strong>Oficio&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Publicado por: </strong> SkillConnect&nbsp;|&nbsp; 
                                <strong class="info-postulacion">Aplicado el:</strong> &nbsp;10 de Nov de 2024
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="perfil-contenedor-btn">
                    <a href="">Eliminar</a>
                    <!-- <button class="btn btn-primary" id="miboton">Editar perfil</button> -->
                </div>
            </div>

            <!-- Include de menu lateral -->
            <?php include 'include/menu_lateral.php'; ?>
            
        </div>    
    </div>
</body>

<?php include 'include/footer.php'; ?>

</html>