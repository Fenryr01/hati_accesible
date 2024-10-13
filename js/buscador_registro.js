document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const cudFilter = document.getElementById("cud_filter");
    const visitadoFilter = document.getElementById("visitado_filter");
    const tablaRegistro = document.getElementById("tabla_registro");
    const resultadoTexto = document.getElementById("resultado_texto"); // Elemento para mostrar el número de resultados
    let currentSortColumn = "apellido";
    let currentSortOrder = "asc";

    // Inicializa la flecha en la columna "apellido"
    const initialHeader = document.querySelector('th[data-column="apellido"]');
    initialHeader.setAttribute("data-order", currentSortOrder);
    const initialIndicator = initialHeader.querySelector('.sort-indicator');
    initialIndicator.innerHTML = currentSortOrder === "asc" ? '&#9650;' : '&#9660;'; // Flecha hacia arriba

    // Función para realizar la búsqueda y ordenamiento
    function buscarDatos() {
        const searchValue = searchInput.value;
        const cudValue = cudFilter.value;
        const visitadoValue = visitadoFilter.value;

        // Crear la solicitud AJAX
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `php/buscador_registro.php?search=${encodeURIComponent(searchValue)}&cud_filter=${encodeURIComponent(cudValue)}&visitado_filter=${encodeURIComponent(visitadoValue)}&sort_column=${encodeURIComponent(currentSortColumn)}&sort_order=${encodeURIComponent(currentSortOrder)}`,
            true
        );
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                tablaRegistro.innerHTML = xhr.responseText;

                // Contar el número de filas de resultados (asumiendo que cada fila de datos es un <tr>)
                const rowCount = tablaRegistro.querySelectorAll('tr.data-row').length;
                resultadoTexto.textContent = `Resultados encontrados: ${rowCount}`;

                // Agregar event listeners a los checkboxes después de cargar los datos
                const checkboxes = document.querySelectorAll('.visitado-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        const id = this.getAttribute('data-id');
                        const visitado = this.checked ? 1 : 0;
                        actualizarVisitado(id, visitado);
                    });
                });
            }
        };
        xhr.send();
    }

    // Función para actualizar el estado de "visitado" en la base de datos
    function actualizarVisitado(id, visitado) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/actualizar_visitado.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`id=${id}&visitado=${visitado}`);
    }

    // Evento para manejar el ordenamiento al hacer clic en las cabeceras
    document.querySelectorAll(".sortable").forEach(header => {
        header.addEventListener("click", function () {
            const column = this.getAttribute("data-column");
            const currentOrder = this.getAttribute("data-order");

            // Alternar el orden de ascendente a descendente
            const newOrder = currentOrder === "asc" ? "desc" : "asc";
            this.setAttribute("data-order", newOrder);

            // Ocultar flechas en todos los encabezados
            document.querySelectorAll(".sortable .sort-indicator").forEach(indicator => {
                indicator.innerHTML = ''; // Limpiar todos los indicadores
            });

            // Mostrar el indicador de ordenamiento solo en la columna actual
            const sortIndicator = this.querySelector('.sort-indicator');
            sortIndicator.innerHTML = newOrder === "asc" ? '&#9650;' : '&#9660;'; // flecha hacia arriba o hacia abajo

            // Actualizar las variables globales para ordenar
            currentSortColumn = column;
            currentSortOrder = newOrder;

            // Realizar la búsqueda y actualizar la tabla
            buscarDatos();
        });
    });

    // Ejecutar la búsqueda en tiempo real y al cargar la página
    searchInput.addEventListener("input", buscarDatos);
    cudFilter.addEventListener("change", buscarDatos);
    visitadoFilter.addEventListener("change", buscarDatos);
    buscarDatos(); // Llamar la función al cargar la página para mostrar todos los datos ordenados
});
