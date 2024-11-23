document.addEventListener("DOMContentLoaded", function () {
    // Elementos del DOM
    const searchInput = document.getElementById("search");
    const cudFilter = document.getElementById("cud_filter");
    const visitadoFilter = document.getElementById("visitado_filter");
    const tablaRegistro = document.getElementById("tabla_registro");
    const resultadoTexto = document.getElementById("resultado_texto");
    const prevPageBtn = document.getElementById("prevPage");
    const nextPageBtn = document.getElementById("nextPage");
    const currentPageInput = document.getElementById("currentPage");
    const totalPagesSpan = document.getElementById("totalPages");

    let currentPage = 1;
    let totalPages = 1;

    // Variables para ordenar
    let currentOrderColumn = 'apellido';
    let currentOrderDirection = 'asc';

    // Función para buscar datos
    function buscarDatos(page = 1) {
        const searchValue = searchInput.value.trim();
        const cudValue = cudFilter.value;
        const visitadoValue = visitadoFilter.value;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", `php/buscador_registro.php?search=${encodeURIComponent(searchValue)}&cud_filter=${encodeURIComponent(cudValue)}&visitado_filter=${encodeURIComponent(visitadoValue)}&page=${page}&orderColumn=${currentOrderColumn}&orderDirection=${currentOrderDirection}`);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Validar la respuesta antes de procesarla
                if (response && response.data !== undefined) {
                    tablaRegistro.innerHTML = response.data;
                    resultadoTexto.textContent = `Resultados encontrados: ${response.total_results || 0}`;
                    totalPages = response.total_pages || 1;
                    totalPagesSpan.textContent = ` / ${totalPages}`;
                    currentPageInput.value = page;

                    // Habilitar/Deshabilitar botones de paginación
                    prevPageBtn.disabled = (currentPage === 1);
                    nextPageBtn.disabled = (currentPage >= totalPages);
                }
            } else {
                console.error("Error en la solicitud:", xhr.statusText);
            }
        };
        xhr.onerror = function () {
            console.error("Error de conexión");
        };
        xhr.send();
    }

    // Eventos de búsqueda
    searchInput.addEventListener("input", () => {
        currentPage = 1; // Reiniciar a la primera página al buscar
        buscarDatos();
    });
    cudFilter.addEventListener("change", () => {
        currentPage = 1; // Reiniciar a la primera página al cambiar el filtro
        buscarDatos();
    });
    visitadoFilter.addEventListener("change", () => {
        currentPage = 1; // Reiniciar a la primera página al cambiar el filtro
        buscarDatos();
    });

    // Paginación
    prevPageBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            buscarDatos(currentPage);
        }
    });

    nextPageBtn.addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            buscarDatos(currentPage);
        }
    });

    currentPageInput.addEventListener("change", (event) => {
        const page = parseInt(event.target.value);
        if (!isNaN(page) && page >= 1 && page <= totalPages) {
            currentPage = page;
            buscarDatos(currentPage);
        }
    });

    // Ordenar tabla
    const sortableHeaders = document.querySelectorAll('.sortable');

    sortableHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const column = header.dataset.column;

            // Alternar la dirección del orden
            currentOrderDirection = (header.dataset.order === 'asc') ? 'desc' : 'asc';
            header.dataset.order = currentOrderDirection;

            // Actualizar el orden de la columna actual
            currentOrderColumn = column;

            // Buscar datos con el nuevo orden
            buscarDatos(currentPage);
            updateSortIndicators();
        });
    });

    // Actualizar indicadores de orden
    function updateSortIndicators() {
        sortableHeaders.forEach(header => {
            const indicator = header.querySelector('.sort-indicator');

            // Mostrar el indicador en la cabecera ordenada
            if (header.dataset.column === currentOrderColumn) {
                indicator.textContent = (header.dataset.order === 'asc') ? '▲' : '▼';
            } else {
                indicator.textContent = '';
            }
        });
    }

    // Inicializar búsqueda al cargar la página
    buscarDatos();
});
