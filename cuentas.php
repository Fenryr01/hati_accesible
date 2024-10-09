<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/logo_accesibilidad.png">
    <title>Gestión de Cuentas y Roles</title>
</head>
<body>

    <?php include("navbar.php"); 
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['username'])) {
        header("Location: index.php"); // Redirigir al inicio si no está autenticado
        exit;
    }

    // Verificar permisos específicos
    if (!isset($_SESSION['permisos']['roles'])) {
        header("Location: index.php"); // Redirigir si no tiene permiso
        exit;
    }
    ?>

    <div class="container_cuentas">
        
        
        <div class="gestion_usuarios_permisos">
            <form class="tabla_usuarios_permisos" id="form-usuarios-permisos" method="POST" action="php/guardar_cambios.php"> 
                <div class="usuarios_table">
                    <h1>USUARIOS</h1>
                    <?php include("php/usuarios.php"); ?>
                </div>
                <div class="permisos_table">
                    <h1>ROLES</h1>
                    <?php include("php/permisos.php"); ?>
                </div>
                <div class="boton-container">
                    <button type="submit">Guardar Cambios</button>
                    <button type="button" id="btn-agregar-usuario">Agregar Usuario</button>
                </div>
            </form>
        </div>
    </div>


    <?php include("footer.html"); ?>
    <script src="js/agregar.js"></script>
    <script src="js/cuentas.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>
