<?php
session_start(); // Asegúrate de iniciar la sesión aquí

// Verificar permisos para acceder a la página (pasado desde el archivo de la página)
$requiredPermission = isset($requiredPermission) ? $requiredPermission : '';

 // Verificar si el usuario está autenticado
if ($requiredPermission && (!isset($_SESSION['username']))) {
    header("Location: index.php"); // Redirigir al inicio si no está autenticado
    exit;
}

// Verificar si el usuario tiene el permiso requerido
if ($requiredPermission && (!isset($_SESSION['permisos'][$requiredPermission]) || !$_SESSION['permisos'][$requiredPermission])) {
    header("Location: index.php");
    exit; // Asegúrate de salir después de la redirección
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="img/logo_accesibilidad_ok.png">
    
</head>
<body>
<header>
    <nav class="navbar" id="navbar">
        <div class="bubble2"></div>
        <div class="bubble2"></div>
        <div class="bubble2"></div>
        <div class="bubble2"></div>
        <div class="navbar-logo">
            <img src="img/logo_accesibilidad_ok.png" alt="Logo" class="logo">
            <span class="navbar-title">DIRECCIÓN DE ACCESIBILIDAD</span>
        </div>
        <div class="navbar-links" id="navbar-links">
            <a href="index.php">Inicio</a>
            
            <?php if (!isset($_SESSION['username'])): ?>
                <a href="registro.php">Registro</a>
            <?php else: ?>
                <?php if (isset($_SESSION['permisos']['formulario_discapacidad']) && $_SESSION['permisos']['formulario_discapacidad']): ?>
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn" id="dropdownFormBtn">Formularios</a>
                        <div class="dropdown-content">
                            <a href="registro.php">Registro</a>
                            <a href="formulario_discapacidad.php">Formulario</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="registro.php">Registro</a>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['permisos']['ver_tablas']) && $_SESSION['permisos']['ver_tablas']): ?>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn" id="dropdownDataBtn">Datos</a>
                    <div class="dropdown-content">
                        <a href="tabla_registro.php">Tabla Registro</a>
                        <a href="tabla_formulario.php">Tabla Formulario</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['permisos']['graficos']) && $_SESSION['permisos']['graficos']): ?>
                <a href="graficos.php">Gráficos</a>
            <?php endif; ?>

            <a href="#contacto">Contacto</a>

            <?php if (isset($_SESSION['username'])): ?>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn" id="dropdownAccountBtn">Cuenta</a>
                    <div class="dropdown-content">
                        <?php if (isset($_SESSION['permisos']['roles']) && $_SESSION['permisos']['roles']): ?>
                            <a href="cuentas.php">Usuarios</a>
                        <?php endif; ?>
                        <a href="php/salir.php">Cerrar Sesión</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="navbar-toggle" id="navbar-toggle">
            <span class="navbar-toggle-icon"></span>
            <span class="navbar-toggle-icon"></span>
            <span class="navbar-toggle-icon"></span>
        </div>
    </nav>
</header>
