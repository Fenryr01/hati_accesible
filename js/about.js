document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones con la clase '.edit-btn'
    const editButtons = document.querySelectorAll('.edit-btn');
    
    // Iterar sobre los botones para añadir un evento a cada uno
    editButtons.forEach(function(editButton) {
        editButton.addEventListener('click', function() {
            // Obtener los datos del botón usando los atributos data-*
            const titulo = editButton.getAttribute('data-titulo');
            const descripcion = editButton.getAttribute('data-descripcion');
            const id = editButton.getAttribute('data-id');
            
            // Mostrar datos en la consola para depuración
            console.log("Editando registro con ID:", id);
            console.log("Título:", titulo);
            console.log("Descripción:", descripcion);
            
            // Aquí podrías rellenar un formulario/modal con los valores
            // Ejemplo: Llenar inputs en un formulario visible
            const tituloInput = document.getElementById('tituloInput');
            const descripcionInput = document.getElementById('descripcionInput');
            const idInput = document.getElementById('idInput');

            if (tituloInput && descripcionInput && idInput) {
                tituloInput.value = titulo;
                descripcionInput.value = descripcion;
                idInput.value = id;
            }

            // Opcional: Mostrar un modal con el formulario (si usas un modal)
            const modal = document.getElementById('editModal');
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });
});
