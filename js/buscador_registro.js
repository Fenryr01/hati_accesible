document.addEventListener("DOMContentLoaded", function () {
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

    function buscarDatos(page = 1) {
        const searchValue = searchInput.value;
        const cudValue = cudFilter.value;
        const visitadoValue = visitadoFilter.value;

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `php/buscador_registro.php?search=${encodeURIComponent(searchValue)}&cud_filter=${encodeURIComponent(cudValue)}&visitado_filter=${encodeURIComponent(visitadoValue)}&page=${page}&orderColumn=${currentOrderColumn}&orderDirection=${currentOrderDirection}`
        );
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Limpia saltos de línea y espacios en blanco de la respuesta
                const response = JSON.parse(xhr.responseText);
                const cleanedData = response.data.replace(/\s+/g, ' ').trim(); // Reemplaza múltiples espacios y saltos de línea por uno solo
        
                tablaRegistro.innerHTML = cleanedData;
                resultadoTexto.textContent = `Resultados encontrados: ${response.total_results}`;
                totalPages = response.total_pages;
                totalPagesSpan.textContent = ` / ${totalPages}`;
                currentPageInput.value = page;
        
                prevPageBtn.disabled = (page === 1);
                nextPageBtn.disabled = (page === totalPages || totalPages === 0);
            }
        };
        xhr.send();
    }

    // Eventos de búsqueda
    searchInput.addEventListener("input", () => buscarDatos());
    cudFilter.addEventListener("change", () => buscarDatos());
    visitadoFilter.addEventListener("change", () => buscarDatos());

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
            
            // Ocultar el indicador en las cabeceras que no están siendo ordenadas
            if (header.dataset.column === currentOrderColumn) {
                // Mostrar el indicador en la cabecera ordenada
                indicator.textContent = (header.dataset.order === 'asc') ? '▲' : '▼';
            } else {
                // Ocultar los indicadores en las demás cabeceras
                indicator.textContent = '';
            }
        });
    }

    // Inicializar búsqueda al cargar la página
    buscarDatos();
});
