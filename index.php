<?php
    // Incluir el archivo con la conexión y las consultas
    include("php/con_home.php");

    include("navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    

    <title>Dirección de Accesibilidad</title>
</head>


<body>

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

    <!-- Banner -->
    <section id="banner" style="background-image: url('<?php echo $registro_id_1['imgurl']; ?>');">
        <div class="banner-content">
            <!-- Mostrar botón de edición solo si el usuario tiene permiso para ver noticias -->
            <?php if (isset($_SESSION['permisos']['noticias']) && $_SESSION['permisos']['noticias']): ?>
                <button class="edit-btn"
                    data-titulo="<?php echo $registro_id_1['titulo']; ?>"
                    data-descripcion="<?php echo $registro_id_1['descripcion']; ?>"
                    data-imgurl="<?php echo $registro_id_1['imgurl']; ?>"
                    data-id="<?php echo $registro_id_1['id']; ?>">
                    ✎
                </button>
            <?php endif; ?>
            <h1><?php echo $registro_id_1['titulo']; ?></h1>
            <p><?php echo $registro_id_1['descripcion']; ?></p>
            <a href="registro.php">
                <button class="button_banner">REGISTRATE</button>
            </a>
        </div>
    </section>

    <!-- Noticias -->
    <main id="noticias">
        <div class="noticia-row">
            <?php while ($registro = $result_otros->fetch_assoc()): ?>
                <div class="noticia-item">
                    <div class="noticia-img">
                        <img src="<?php echo $registro['imgurl']; ?>" alt="Imagen Noticia">
                    </div>
                    <div class="noticia-texto">
                        <h3><?php echo $registro['titulo']; ?></h3>
                        <p><?php echo $registro['descripcion']; ?></p>
                    </div>
                    <!-- Mostrar botón de edición solo si el usuario tiene permiso para ver noticias -->
                    <?php if (isset($_SESSION['permisos']['noticias']) && $_SESSION['permisos']['noticias']): ?>
                        <button class="edit-btn"
                            data-titulo="<?php echo $registro['titulo']; ?>"
                            data-descripcion="<?php echo $registro['descripcion']; ?>"
                            data-imgurl="<?php echo $registro['imgurl']; ?>"
                            data-id="<?php echo $registro['id']; ?>">
                            ✎
                        </button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <?php include("footer.html"); ?>
    <script src="js/banner.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
