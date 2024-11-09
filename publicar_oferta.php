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
    // $profesion = $_POST['profesion']; //revisar <-------------------------------
    $descripcion = $_POST['descripcion'];
    $honorarios = $_POST['honorarios'];
    $telefono = $_POST['telefono'];
    $ubicacion = $_POST['ubicacion'];
    // $whatsapp_url = $_POST['whatsapp_url']; //revisar <-------------------------------
    $foto_url = 'ruta_de_la_foto.jpg';

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
    <link rel="stylesheet" href="css/miestilo.css">
</head>
<body>
    <?php include 'include/header.php'; ?>
    <?php include 'include/banner.php'; ?>
    

    <h2 style="text-align: center; margin: 0px 0px 30px 0px; border-radius: 0">Nueva oferta</h2>
    
    <div class="resultados">
        <div class="contenedor-oferta">
            <form method="POST" action="publicar_oferta.php" class="form-control mb-3">
                <input type="text" name="nombre" placeholder="Nombre del puesto" class="form-control mb-3" required>
                <div class="">
                    <label for="" class="mb-3">Selecciona categoria:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Profesión
                        </label>
                    </div>
                    <div class="form-check mb-3 form-check-inline">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Oficio
                        </label>
                    </div>
                    <div class="form-check mb-3 form-check-inline">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Pasantía
                        </label>
                    </div>
                </div>
                <textarea name="descripcion" placeholder="Descripción del puesto" class="form-control mb-3" required ></textarea>
                <div class="input-group">
                    <span class="input-group-text mb-3" id="basic-addon1">$</span>
                    <input type="number" step="0.01" name="honorarios" placeholder="Sueldo (USD)" class="form-control mb-3" required>
                </div>
                
                <div class="input-group mb-3">
                    <select class="form-control custom-select" name="ubicacion">
                        <option selected value="Santa Ana">Selecciona ubicación</option>
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
                <!-- <input type="text" name="ubicacion" placeholder="Departamento" class="form-control mb-3" required> -->
                <textarea name="descripcion" placeholder="Sobre la empresa..." class="form-control mb-3" required ></textarea>
                <br>
                <label class="mb-3">Sube una imagen para tu oferta, logo de la empresa o imagen representativa:</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02">
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="email" name="email" placeholder="Correo de contacto" class="form-control" required>
                </div>
                <input type="tel" pattern="^\d{4}-\d{4}$" name="telefono" placeholder="Contacto de WhatsApp" class="form-control mb-3" title="Debe tener el formato xxxx-xxxx">
                <div class="contenedor-button">
                    <button type="submit" class="btn btn-primary" id="miboton">Publicar oferta</button>
                    <a href="index.php"><button type="button" 
                    class="btn btn-danger">Cancelar</button></a>
                </div>
                
            </form>
        </div>

        <!-- Insercion de menu lateral -->
        <?php include 'include/menu_lateral.php'; ?>
    </div>

    
</body>

<?php include 'include/footer.php'; ?>
</html>
