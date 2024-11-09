<?php
session_start();

// Asegurarse de que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nombre_usuario = $_SESSION['nombre'];

include 'config.php';
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

    <div class="contenedor-perfil">
        <div class="div-perfil">
            <div class="div-perfil-izq">
                <h2><strong>Mi perfíl</strong></h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Foto de perfil<br>
                        <img src="./img/svg/user-man.svg" alt=""></strong>
                        <a href="">Editar foto de perfil</a>
                    </li>
                    <li class="list-group-item"><strong>Profesión/Oficio: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item"><strong>Nombre: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item"><strong>DUI: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item"><strong>Dirección: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item"><strong>Correo: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item"><strong>Teléfono: </strong><input class="form-control" readonly></li>
                    <li class="list-group-item">
                        <strong>Sobre mi:<br></strong>
                        <textarea name="" id="" class="form-control" rows="4" readonly></textarea>
                    </li>
                    <li class="list-group-item"><strong>Tipo de perfil: </strong><input class="form-control" readonly></li>
                </ul>
                <div class="perfil-contenedor-btn">
                    <button class="btn btn-primary" id="miboton">Editar perfil</button>
                </div>
            </div>

            <!-- Include de menu lateral -->
            <?php include 'include/menu_lateral.php'; ?>
        </div>    
    </div>
</body>

<?php include 'include/footer.php'; ?>
</html>