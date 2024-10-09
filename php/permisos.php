<?php
include("db.php"); // Incluir la conexión a la base de datos

// Nombres personalizados de los permisos que quieres mostrar en el encabezado
$encabezados_permisos = [
    'noticias' => 'Noticias',
    'ver_tablas' => 'Ver Tablas',
    'editar_tablas' => 'Editar Tablas',
    'graficos' => 'Graficos',
    'roles' => 'Roles',
    'formulario_discapacidad' => 'Formulario'
];

// Consulta para obtener los permisos
$query_permisos = "SELECT * FROM permisos"; 
$resultado_permisos = $conexion->query($query_permisos);

// Consulta para obtener los usuarios
$query_usuarios = "SELECT id, nombre, permisos_id FROM usuarios"; 
$resultado_usuarios = $conexion->query($query_usuarios);

if ($resultado_permisos && $resultado_permisos->num_rows > 0 && $resultado_usuarios && $resultado_usuarios->num_rows > 0) {
    // Inicializamos el encabezado de la tabla
    echo '<table class="permisos_tablas">';
    echo '<tr><th>Usuarios</th>'; // Encabezado de Usuario

    // Obtener los nombres de los permisos (campos)
    $permiso_columnas = $resultado_permisos->fetch_assoc();
    
    // Mostrar los nombres de los permisos en los encabezados usando los nombres personalizados
    foreach ($permiso_columnas as $nombre_permiso => $valor) {
        if ($nombre_permiso != 'id' && isset($encabezados_permisos[$nombre_permiso])) { // Excluir el campo ID y mostrar solo los personalizados
            echo '<th>' . htmlspecialchars($encabezados_permisos[$nombre_permiso]) . '</th>';
        }
    }
    echo '</tr>';

    // Reiniciar el puntero de resultados de permisos para obtener nuevamente los permisos
    $resultado_permisos->data_seek(0); // Volver al inicio de los resultados de permisos

    // Iterar sobre los usuarios
    while ($usuario = $resultado_usuarios->fetch_assoc()) {
        $id_usuario = $usuario['id'];
        
         // Excluir al administrador (ID 1)
         if ($id_usuario == 1) {
            continue; // Saltar la iteración si es el administrador
        }

        $nombre_usuario = htmlspecialchars($usuario['nombre']);
        $permisos_id = $usuario['permisos_id'];

        echo '<tr>';
        echo '<td data-label="">' . $nombre_usuario . '</td>';

        // Consultar los permisos para cada usuario
        $permisos_usuario_query = "SELECT * FROM permisos WHERE id = $permisos_id";
        $resultado_permisos_usuario = $conexion->query($permisos_usuario_query);
        $permisos_usuario = $resultado_permisos_usuario->fetch_assoc();

        // Mostrar checkboxes para cada permiso
        foreach ($permiso_columnas as $nombre_permiso => $valor) {
            if ($nombre_permiso != 'id' && isset($encabezados_permisos[$nombre_permiso])) { // Excluir el campo ID y mostrar solo los personalizados
                echo '<td>';
                echo '<span class="label-permiso">' . htmlspecialchars($encabezados_permisos[$nombre_permiso]) . '</span>'; // Label con clase específica
                echo '<input type="checkbox" class="custom-checkbox" id="permiso_' . $id_usuario . '_' . $nombre_permiso . '" name="permisos[' . $id_usuario . '][' . $nombre_permiso . ']" value="1" ' . (isset($permisos_usuario[$nombre_permiso]) && $permisos_usuario[$nombre_permiso] == 1 ? 'checked' : '') . '>';
                echo '<label class="custom-label" for="permiso_' . $id_usuario . '_' . $nombre_permiso . '">
                        <div class="tick_mark"></div>
                    </label>';
                echo '</td>';
            }
        }

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No hay usuarios o permisos disponibles.</p>';
}

$conexion->close(); // Cerrar la conexión
?>
