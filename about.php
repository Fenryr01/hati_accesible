<?php
    // Incluir el archivo con la conexión y las consultas
    include("php/con_about.php");

    include("navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Dirección de Accesibilidad</title>
</head>
<body class="body_about">

    <div id="overlay" class="overlay"></div>
    <!-- Popup para editar la página home -->
    <div class="popup-overlay_home" id="popup_edit_home" style="display: none;">
        <div class="popup-content_home">
            <div class="popup-header_home">
                <h2 id="titulo-popup">Editar Noticia</h2>
                <button class="close-btn_home" onclick="closePopup()">✖</button>
            </div>
            <div class="popup_form">
                <form action="php/con_home.php" method="POST">
                    <input type="hidden" id="id_noticia" name="id_noticia">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo">

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion"></textarea>

                    <label for="imgurl">URL de la imagen:</label>
                    <input type="text" id="imgurl" name="imgurl">

                    <button class="button_edit_home" type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <div class="background"></div>
        <div class="background-texture"></div>
        <header class="header_about">
        <div class="left-content">
            <p class="stay-home">¡Comprometidos con la Inclusión!</p>
            <h1 class="about_tittle">Dirección de Accesibilidad</h1>

        </div>
        
            <div class="rigth-content">
                <svg class="accesibilidad_svg" version="1.1" viewBox="0 0 1864 1848" width="466" height="462" xmlns="http://www.w3.org/2000/svg">
                    <g id="blanco">
                        <circle cx="900" cy="805" r="800" fill="white" />
                    <g id="cuerpo">
                        <path transform="translate(1633,476)" d="m0 0h39l20 5 19 9 14 9 7 6v2l4 2 9 10 10 16 6 12 6 19 1 6v39l-2 8-4 14-9 19-7 10-6 8-15 14-13 8-14 7-15 5-11 3-10 1h-20l-9-1-5-2-10-2-16-7-14-8-6-4h-7l-42 19-59 25-41 16-18 7-26 9-30 11-41 13-36 11-32 9-46 12-48 11-52 10-56 9-39 5-38 3-19 2h-17l3 7 8 12 7 10 9 14 25 37 13 20 7 10 96 144 11 16 28 42 11 17 16 24 7 10 11 17 32 48 17 25 32 48v2l17-4 11-3h28l12 3 10 2 18 8 11 7 10 7 3 2v2l4 2v2h2l9 11 9 13 8 18 4 15 3 21-1 18-3 16-8 22-10 16-14 15-8 8-11 8-16 8-12 4-7 2-1 1-8 1h-41l-14-4-14-6-11-6-13-10-16-16-8-11-8-15-5-13-4-18-2-17 4-26 6-18 8-16 8-12 4-5h2l-2-6-8-10-11-18-8-11-27-41-16-24-10-14-10-16-9-13-48-72-7-10-10-15-9-14-11-16-10-15-11-17-13-19-12-19-11-16-19-28-7-10-7-11-48-72-10-13v-2l-5 3-7 10-10 16-7 11-12 18-13 19-7 11-18 27-12 19-7 10-9 14-16 24-14 22-28 42-11 17-19 29-14 22-9 13-11 17-18 27-13 20-6 9-11 17-20 30-11 17-8 12-10 16-3 5v5l8 11 7 11 5 11 6 17 2 18v17l-1 15-5 18-7 16-8 13-16 17-12 10-18 10-14 5-9 3-8 1h-40l-7-3-11-2-16-8-11-7-14-12-8-8-10-13-10-20-4-11-3-19-1-4v-14l4-24 7-19 10-18 11-13 10-10 11-8 14-8 18-7 12-2 5-2h30l9 3 11 2 4 1 7-9 30-45 11-17 16-24 9-14 18-27 14-22 9-13 11-17 9-14 16-24 7-11 18-27 7-11 16-24 10-16 7-10 10-15 9-14 8-12 12-19 7-11 10-14 13-20 10-15 7-11 7-10 13-21 6-10 1-5h-27l-30-3-27-2-53-7-57-10-48-10-42-10-40-11-19-6-19-7-6-7v-8l8-16 7-10 4-7 2-2h8l42 12 41 11 43 10 28 6 33 6 10 2 17 2 10 2 30 4 23 2 2 1 31 2 26 2 20 1h62l32-2 40-3 13-2 23-2 54-8 56-11 31-7 37-9 38-10 53-16 25-8 24-8 59-21 36-14 27-11 60-26 9-4 7-3-1-10-2-5-4-18v-28l3-9 2-13 7-16 9-15 11-14 8-7 15-11 15-8 15-5z" fill="#060405"/>
                        </g>
                    <g id="mano">
                        <path transform="translate(138,476)" d="m0 0h14l17 3 10 2 15 6 16 9 12 9 11 11 12 16 8 16 5 15 2 10 1 12v13l-1 16-5 18-3 10 1 4 22 10 21 9 13 6 32 13 27 11 35 13 33 12 29 10 32 10 21 6 2 4-37 37-3 4-7-1-27-8-48-17-31-11-31-12-36-15-35-15-48-22-7-1-8 6-18 8-12 4-24 2-26-1-17-5-21-10-18-13-7-7-13-18-10-19-5-17-3-17v-19l5-23 6-16 7-13 8-11 8-9h2l2-4 11-9 9-6 17-8 11-4 14-2 1-1z" fill="#040304"/>
                        <path transform="translate(139,530)" d="m0 0h11l10 1 16 7 11 8 7 7 8 14 5 12 1 5v19l-4 13-7 13-8 10-14 10-15 6-5 1h-21l-15-5-14-9-6-5-9-13-5-11-3-11v-17l3-12 7-14 7-10 13-10 13-6 6-2z" fill="#48C6F5"/>
                    </g>
                    <g id="brazo">
                        <path transform="translate(526,751)" d="m0 0 12 1 42 11 51 12 40 8 22 4 17 2 17 3 9 1 2 1 35 3 12 2 41 3 38 2 1 3-4 6-7 11-8 16-5 7-4 7-2 2h-20l-29-3-29-2-53-7-58-10-43-9-50-12-51-14-15-4-1-4 36-36h2z" fill="#050406"/>
                    </g>
                    <g id="otros">
                        <path transform="translate(1643,529)" d="m0 0h19l12 3 14 7 8 6 10 13 6 12 4 14v16l-4 13-8 16-9 10-8 6-10 5-19 5h-10l-17-4-15-8-10-9-9-13-5-11-2-12v-13l2-11 5-12 9-13 10-9 12-7 9-3z" fill="#48C6F5"/>
                        <path transform="translate(469,1406)" d="m0 0 15 1 12 3 16 9 11 11 6 9 5 13 2 9v18l-4 14-5 10-9 11-10 8-13 6-9 3-5 1h-15l-17-5-9-5-10-8-7-7-6-9-5-12-2-10 1-19 5-15 7-11 9-10 13-9 7-3z" fill="#48C6F5"/>
                        <path transform="translate(1305,1406)" d="m0 0 17 1 11 3 12 6 12 11 8 10 6 15 2 13v11l-4 16-7 13-12 13-11 7-18 6-5 1h-14l-16-5-13-7-12-11-7-10-4-9-2-9-1-16 3-16 4-9 6-9 11-12 11-7 7-3z" fill="#48C6F5"/>
                        <path transform="translate(862,212)" d="m0 0h58l23 4 20 6 19 7 16 8 14 8 14 10 13 10 16 15 11 12 8 11 11 16 6 10 11 24 9 28 4 18 1 8v59l-2 12-6 24-8 23-8 16-9 16-10 15-12 14-22 22-11 9-15 10-14 8-16 8-15 6-19 6-17 4-28 3h-25l-28-3-19-4-23-8-28-13-18-12-10-7-14-12-16-16-7-8-10-13-11-18-11-21-6-15-3-9-6-25-1-5-2-24-1-7v-13l2-11 1-20 5-20 9-27 11-23 11-18 9-12 9-11 21-21 11-9 17-12 14-8 23-11 17-6 22-5z" fill="#48C6F5"/>
                        <path transform="translate(862,212)" d="m0 0h58l23 4 20 6 19 7 16 8 14 8 14 10 13 10 16 15 11 12 8 11 11 16 6 10 11 24 9 28 4 18 1 8v59l-2 12-6 24-8 23-8 16-9 16-10 15-12 14-22 22-11 9-15 10-14 8-16 8-15 6-19 6-17 4-28 3h-25l-28-3-19-4-23-8-28-13-18-12-10-7-14-12-16-16-7-8-10-13-11-18-11-21-6-15-3-9-6-25-1-5-2-24-1-7v-13l2-11 1-20 5-20 9-27 11-23 11-18 9-12 9-11 21-21 11-9 17-12 14-8 23-11 17-6 22-5zm8 53-23 5-16 5-20 9-12 7-16 12-15 14-8 8-13 18-8 12-10 25-6 20-3 13-1 19v16l2 17 6 25 9 21 8 15 10 15 12 14 8 8 11 9 9 7 17 10 20 9 21 7 12 2 30 2 25-2 15-3 26-9 19-10 9-5 14-11 15-14 9-11 7-8 12-20 8-18 5-15 3-12 3-22v-25l-4-24-6-21-9-21-9-16-14-18-18-18-10-8-10-7-11-6-16-8-16-6-21-5-9-1z" fill="#050304"/>
                    </g>
                    <g id="bordes">
                        <path transform="translate(892,3)" d="m0 0h16l42 1 43 4 39 5 39 8 26 6 42 12 35 12 38 15 38 17 33 17 19 11 28 17 24 16 10 7 17 12 18 14 10 9 11 8 8 7v2l4 2 7 7 8 7 10 9 32 32 9 11 10 10 7 8 33 42 12 17 24 36 9 15 14 25 2 3-1 5-20 8-17 8-8 5-4-4-13-23-14-23-10-14-11-16-14-20-12-14-10-13-14-15-13-15-36-36-11-9-13-13-11-9-14-11-11-8-10-8-19-13-15-10-24-15-17-10-20-11-32-16-25-11-27-11-47-16-44-12-39-8-39-6-46-5-11-1h-84l-47 5-29 4-39 7-29 7-36 10-35 12-28 11-25 11-25 12-20 10-18 10-15 9-13 8-33 22-18 13-18 14-10 9-11 8-8 8-8 7-59 59-16 20-14 18-10 13-8 10-4 7-7 9-11 18-12 19-12 21-6-1-19-8-8-3-18-5 1-6 5-9 12-20 24-38 16-22 9-12 10-13 6-8 10-11 6-8 9-10 14-15 50-50 8-7 14-12 11-9 12-9 13-10 15-11 10-7 24-16 31-19 42-22 16-8 26-12 30-12 30-11 21-6 18-6 32-8 27-6 26-5 48-6 19-2 16-1z" fill="#060405"/>
                        <path transform="translate(1702,749)" d="m0 0 2 1 1 36 1 11v34l-1 6-1 43-1 14-2 8-3 27-4 24-4 23-7 31-5 18-12 40-11 32-10 24-11 25-12 26-10 19-9 16-8 14-14 23-13 20-10 15-12 15-10 14-8 10-10 12-9 11-7 7-7 8-21 21-7 8-6 7-4-1-7-11-8-11-9-10-6-8 1-4h2l2-4 9-9 7-8 13-13 1-2h2l2-4 9-10 8-10 10-13 8-10 7-10 8-11 7-10 11-17 7-11 14-24 12-21 11-23 9-19 13-31 14-39 11-36 9-36 5-23 3-19 5-33 2-26 2-19 1-99 1-1 19-1 27-5z" fill="#060505"/>
                        <path transform="translate(89,748)" d="m0 0 10 1 18 5 25 4 1 1v10l-2 17v49l3 39 2 28 2 11 6 38 9 42 6 23 9 30 11 30 10 25 11 26 20 40 14 24 12 21 10 15 12 17 10 14 8 11 12 15 9 11 9 10 6 8 8 8 7 8 14 14 1 4-16 17-13 19-2 4-4-2-5-4-4-5-28-28-10-13-11-12-8-11-10-12-9-12-13-19-9-13-10-16-14-22-6-11-10-18-20-40-16-38-12-32-12-37-8-28-5-22-7-31-3-19-5-35-2-22-2-16v-115z" fill="#060405"/>
                        <path transform="translate(630,1520)" d="m0 0 9 1 36 12 36 10 29 7 43 8 29 3 14 2 50 3h42l49-3 24-3 19-2 37-7 36-8 16-4 42-13 11-4h3l7 17 6 11 11 17v3l-38 13-35 10-36 9-44 8-34 5-42 4-21 1h-69l-28-2-40-4-49-8-40-9-31-8-32-10-31-11-1-4 9-15 6-12z" fill="#060405"/>
                    </g>
                </svg>
            </div>
        </header>


    <!-- Noticias -->
    <svg class="editorial"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none">
    <defs>
    <path id="gentle-wave"
    d="M-160 44c30 0 
        58-18 88-18s
        58 18 88 18 
        58-18 88-18 
        58 18 88 18
        v44h-352z" />
    </defs>
    <g class="parallax">
        <use xlink:href="#gentle-wave" x="50" y="0" fill="#e7e7e760"/>
        <use xlink:href="#gentle-wave" x="50" y="3" fill="#e7e7e78f"/>
        <use xlink:href="#gentle-wave" x="50" y="6" fill="#e7e7e7cc"/>  
    </g>
    </svg>
    <section class="mision">
        <div class="mision-content">
            <!-- Mostrar botón de edición solo si el usuario tiene permiso para editar noticias -->
            <?php if (isset($_SESSION['permisos']['noticias']) && $_SESSION['permisos']['noticias']): ?>
                <button class="edit-btn"
                    data-titulo="<?php echo htmlspecialchars($registro_id_5['titulo'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-descripcion="<?php echo htmlspecialchars($registro_id_5['descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-id="<?php echo $registro_id_5['id']; ?>">
                    ✎
                </button>
            <?php endif; ?>
            
            <!-- Mostrar título y descripción -->
            <h1><?php echo htmlspecialchars($registro_id_5['titulo'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <p><?php echo htmlspecialchars($registro_id_5['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </section>


    <section class="contacto">
        <div class="contacto-content">
            <div class="titulo_contacto">
                <h1>Contáctanos</h1>
            </div>
            <div class="contacto-info">
                <ul>
                    <li class="card email-card">
                        <a>
                            <div class="circle">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </a>
                        <p>example@dominio.com</p>
                    </li>
                    <li class="card instagram-card">
                        <a>
                            <div class="circle">
                                <i class="fab fa-instagram"></i>
                            </div>
                        </a>
                        <p>@Usuario Instagram</p>
                    </li>

                    <li class="card phone-card">
                        <a>
                            <div class="circle">
                                <i class="fas fa-phone"></i>
                            </div>
                        </a>
                        <p>+1 234 567 89</p>
                    </li>
                    <li class="card address-card">
                        <a>
                            <div class="circle">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </a>
                        <p>Leandro N. Alem, B7100 Dolores, Buenos Aires</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>





    <div class="map">
        <h1 class="titulo_ubicacion">¿Dónde puedes encontrarnos?</h1>
    </div>
    <div class="row">
    <!-- Imagen en el lado izquierdo -->
        <div class="box box--left">
            <div class="box__inner">
                <img src="https://dolores.gob.ar/wp-content/uploads/2019/03/TALLERES-JUVENTUD-800x400.jpg" 
                    alt="Imagen de la puerta del lugar" />
            </div>
        </div>
            <!-- Mapa en el lado derecho -->
        <div class="box box--right">
            <div class="box__inner">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d200.93397781252003!2d-57.678507014308536!3d-36.31367343317862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95999e5b4960f48f%3A0xe77be56d70af690c!2sEl%20Condor%20Centro%20Civico%20De%20Participacion!5e0!3m2!1ses!2sar!4v1732653212649!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>




    <?php include("footer.html"); ?>
    <script src="js/about.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
