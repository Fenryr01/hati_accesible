<?php 
include("db.php"); // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Primero eliminar usuarios
    if (isset($_POST['eliminar'])) {
        $ids_a_eliminar = $_POST['eliminar'];
        foreach ($ids_a_eliminar as $id_usuario) {
            // Escapar el ID para evitar inyecciones SQL
            $id_usuario = $conexion->real_escape_string($id_usuario);
            
            // Eliminar permisos asociados
            $query_eliminar_permisos = "DELETE FROM permisos WHERE id IN (SELECT permisos_id FROM usuarios WHERE id = $id_usuario)";
            $conexion->query($query_eliminar_permisos);
            
            // Eliminar usuario
            $query_eliminar_usuario = "DELETE FROM usuarios WHERE id = $id_usuario";
            $conexion->query($query_eliminar_usuario);
        }
    }

    // Actualizar usuarios
    foreach ($_POST['nombre'] as $id => $nombre) {
        // Escapar caracteres especiales para evitar inyecciones SQL
        $nombre = $conexion->real_escape_string($nombre);
        
        // Actualizar el nombre siempre
        $query = "UPDATE usuarios SET nombre='$nombre' WHERE id=$id";
        $conexion->query($query);

        // Actualizar la contraseña solo si no está vacía
        if (!empty($_POST['password'][$id]) && $_POST['password'][$id] !== '****') {
            $password = $conexion->real_escape_string($_POST['password'][$id]);
            $query = "UPDATE usuarios SET password='$password' WHERE id=$id";
            $conexion->query($query);
        }
    }

    // Actualizar permisos (solo para usuarios que no han sido eliminados)
    foreach ($_POST['permisos'] as $id_usuario => $permisos) {
        // Verifica si el usuario aún existe
        $query_verificar_usuario = "SELECT permisos_id FROM usuarios WHERE id = $id_usuario LIMIT 1";
        $resultado_verificar_usuario = $conexion->query($query_verificar_usuario);

        if ($resultado_verificar_usuario && $resultado_verificar_usuario->num_rows > 0) {
            $permiso_usuario = $resultado_verificar_usuario->fetch_assoc();
            $permisos_id = $permiso_usuario['permisos_id'];

            // Consultar los permisos existentes
            $query_permisos_existentes = "SELECT * FROM permisos WHERE id = $permisos_id";
            $resultado_permisos_existentes = $conexion->query($query_permisos_existentes);
            $permisos_existentes = $resultado_permisos_existentes->fetch_assoc();

            // Preparar la actualización de permisos
            $query = "UPDATE permisos SET ";
            $query_parts = [];

            // Iterar sobre los permisos
            foreach ($permisos_existentes as $nombre_permiso => $valor) {
                if ($nombre_permiso != 'id') { // Excluir el campo ID
                    // Si el permiso está en el array de permisos enviados y está marcado, establecer 1, si no, 0
                    $checked = isset($permisos[$nombre_permiso]) && $permisos[$nombre_permiso] == '1' ? 1 : 0; 
                    $query_parts[] = "$nombre_permiso = $checked"; // Agregar parte de la consulta
                }
            }

            // Unir las partes de la consulta
            $query .= implode(", ", $query_parts);
            $query .= " WHERE id = $permisos_id"; // Actualizar en la tabla permisos según el ID obtenido

            // Ejecutar la consulta
            $conexion->query($query); 
        }
    }

    // Redirigir a la página de gestión de usuarios o mostrar un mensaje
    header("Location: ../cuentas.php"); // Cambia esto por la página correspondiente
    exit();
}

$conexion->close(); // Cerrar la conexión
?>
