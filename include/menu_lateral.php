<?php if (isset($_SESSION['usuario_id'])): ?>
        <!-- Mostrar solo si el usuario está logueado -->
        <!-- Inicio de menu lateral -->
        <div class="separador-vertical d-none d-sm-block"></div>
        <div class="menu-lateral d-none d-sm-block">
            <!-- <h2>Menu lateral</h2> -->
            <ul class="list-group list-group-flush"> 
                <li class="list-group-item"><a href="./index.php" class="list-group-link">Inicio</a></li>
                <li class="list-group-item"><a href="./miperfil.php" class="list-group-link">Mi perfil</a></li>
                <li class="list-group-item"><a href="./postulaciones.php" class="list-group-link">Mis postulaciones</a></li>
                <li class="list-group-item"><a href="./publicar_oferta.php" class="list-group-link">Publicar oferta</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">Últimas ofertas de trabajo!</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">¿Como hacer mi CV?</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">Plataformas de aprendizajes</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">Sobre SkillConnect</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">Ayuda</a></li>
                <li class="list-group-item"><a href="" class="list-group-link">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="miboton">
                    <a href="#" class="list-group-link" style="color: white;">Quiero ser Premium <img src="img/gif/star-animation.gif" alt="Descripción del GIF" width="30" height="auto"></a>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                            <img src="./img/svg/icon_app_blue.svg" alt="icon-skillconnect" class="d-none d-sm-block" style="height: 30px">&nbsp;
                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: #042254">
                                Premium</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Obten tu suscripción Premium y accede a nuevas características.
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="boton-cerrar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="miboton">Comprar Premium</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Fin de menu lateral -->

        <!-- Botón de menú para versión móvil -->
        <button class="d-block d-sm-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral" id="boton-menu">
            <img src="./img/svg/icon-menu.svg" alt="" height="30">
        </button>

        <!-- Menú lateral -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="menuLateralLabel">Menú</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
            </div>
            <div class="offcanvas-body">
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item"><a href="./index.php" class="list-group-link">Inicio</a></li>
                    <li class="list-group-item"><a href="./miperfil.php" class="list-group-link">Mi perfil</a></li>
                    <li class="list-group-item"><a href="./postulaciones.php" class="list-group-link">Mis postulaciones</a></li>
                    <li class="list-group-item"><a href="./publicar_oferta.php" class="list-group-link">Publicar oferta</a></li>
                    <li class="list-group-item"><a href="" class="list-group-link">Últimas ofertas de trabajo!</a></li>
                    <li class="list-group-item"><a href="" class="list-group-link">¿Cómo hacer mi CV?</a></li>
                    <li class="list-group-item"><a href="" class="list-group-link">Plataformas de aprendizaje</a></li>
                    <li class="list-group-item"><a href="" class="list-group-link">Sobre SkillConnect</a></li>
                    <li class="list-group-item"><a href="" class="list-group-link">Ayuda</a></li>
                    <li class="list-group-item">
                        <!-- Botón para suscripción Premium -->
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="miboton">
                            Quiero ser Premium <img src="img/gif/star-animation.gif" alt="Descripción del GIF" width="30" height="auto">
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="./img/svg/icon_app_blue.svg" alt="icon-skillconnect" class="d-none d-sm-block" style="height: 30px">&nbsp;
                        <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: #042254">Premium</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Obtén tu suscripción Premium y accede a nuevas características.
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="boton-cerrar" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="miboton">Comprar Premium</button>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Mostrar solo si el usuario no está logueado -->
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
