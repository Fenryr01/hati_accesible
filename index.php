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
    <link rel="icon" type="image/png" href="img/logo_accesibilidad_ok.png">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Dirección de Accesibilidad</title>
</head>
<body>

    
    

    <!-- Banner -->
    <section id="banner" style="background-image: url('<?php echo $registro_id_1['imgurl']; ?>');">
        <div class="banner-content">
            <!-- Mostrar botón de edición solo si el usuario tiene permiso para ver noticias -->
            <?php if (isset($_SESSION['permisos']['noticias']) && $_SESSION['permisos']['noticias']): ?>
                <button class="edit-btn">✎</button>
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
                        <button class="edit-btn">✎</button>
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
