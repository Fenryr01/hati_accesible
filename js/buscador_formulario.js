document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const tablaRegistro = document.getElementById("tabla_registro");
    const resultadoTexto = document.getElementById("resultado_texto");
    const prevPageBtn = document.getElementById("prevPage");
    const nextPageBtn = document.getElementById("nextPage");
    const currentPageInput = document.getElementById("currentPage");
    const totalPagesSpan = document.getElementById("totalPages");
    const accordions = document.querySelectorAll('.accordion');
    //FILTROS
    const cudFilter = document.getElementById("cud_filter");
    const asistenciaFilter = document.getElementById("asistencia_filter");
    const discapacidadFilter = document.getElementById("discapacidad_filter");
    const zonaFilter = document.getElementById("zona_filter");
    const edadFilter = document.getElementById("edad_filter");
    const tenenciaFilter = document.getElementById("tenencia_filter");
    const higieneFilter = document.getElementById("higiene_filter");
    const iluminacionFilter = document.getElementById("iluminacion_filter");
    const ordenFilter = document.getElementById("orden_filter");
    const ventilacionFilter = document.getElementById("ventilacion_filter");
    const barrerasFilter = document.getElementById("barreras_filter");
    const añoFilter = document.getElementById("año_filter");
    const mesFilter = document.getElementById("mes_filter");

    let currentPage = 1;
    let totalPages = 1;

    // Variables para ordenar
    let currentOrderColumn = 'apellido';
    let currentOrderDirection = 'asc';

    function buscarDatos(page = 1) {
        const searchValue = searchInput.value;
        const cudValue = cudFilter.value;
        const asistenciaValue = asistenciaFilter.value;
        const discapacidadValue = discapacidadFilter.value;
        const zonaValue = zonaFilter.value;
        const edadValue = edadFilter.value;
        const tenenciaValue = tenenciaFilter.value;
        const higieneValue = higieneFilter.value;
        const iluminacionValue = iluminacionFilter.value;
        const ordenValue = ordenFilter.value;
        const ventilacionValue = ventilacionFilter.value;
        const barrerasValue = barrerasFilter.value;
        const añoValue = añoFilter.value;
        const mesValue = mesFilter.value;

        const xhr = new XMLHttpRequest();
        const queryParams = [
            `search=${encodeURIComponent(searchValue)}`,
            `cud_filter=${encodeURIComponent(cudValue)}`,
            `asistencia_filter=${encodeURIComponent(asistenciaValue)}`,
            `discapacidad_filter=${encodeURIComponent(discapacidadValue)}`,
            `zona_filter=${encodeURIComponent(zonaValue)}`,
            `edad_filter=${encodeURIComponent(edadValue)}`,
            `tenencia_filter=${encodeURIComponent(tenenciaValue)}`,
            `higiene_filter=${encodeURIComponent(higieneValue)}`,
            `iluminacion_filter=${encodeURIComponent(iluminacionValue)}`,
            `ventilacion_filter=${encodeURIComponent(ventilacionValue)}`,
            `orden_filter=${encodeURIComponent(ordenValue)}`,
            `barreras_filter=${encodeURIComponent(barrerasValue)}`,
            `año_filter=${encodeURIComponent(añoValue)}`,
            `mes_filter=${encodeURIComponent(mesValue)}`,
            `page=${page}`,
            `orderColumn=${currentOrderColumn}`,
            `orderDirection=${currentOrderDirection}`
        ].join("&");
        
        const url = `php/buscador_formulario.php?${queryParams}`;
        
        xhr.open("GET", url);        
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                tablaRegistro.innerHTML = response.data;
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
    asistenciaFilter.addEventListener("change", () => buscarDatos());
    discapacidadFilter.addEventListener("change", () => buscarDatos());
    zonaFilter.addEventListener("change", () => buscarDatos());
    edadFilter.addEventListener("change", () => buscarDatos());
    tenenciaFilter.addEventListener("change", () => buscarDatos());
    higieneFilter.addEventListener("change", () => buscarDatos());
    iluminacionFilter.addEventListener("change", () => buscarDatos());
    ventilacionFilter.addEventListener("change", () => buscarDatos());
    ordenFilter.addEventListener("change", () => buscarDatos());
    barrerasFilter.addEventListener("change", () => buscarDatos());
    añoFilter.addEventListener("change", () => buscarDatos());
    mesFilter.addEventListener("change", () => buscarDatos());

    // Reiniciar todos los filtros al hacer clic en el botón "Reiniciar"
    const reiniciarFiltrosBtn = document.getElementById("reiniciarFiltros");
    reiniciarFiltrosBtn.addEventListener("click", function() {
        searchInput.value = ''; // Limpiar el campo de búsqueda
        cudFilter.value = '';
        asistenciaFilter.value = '';
        discapacidadFilter.value = '';
        zonaFilter.value = '';
        edadFilter.value = '';
        tenenciaFilter.value = '';
        higieneFilter.value = '';
        iluminacionFilter.value = '';
        ordenFilter.value = '';
        ventilacionFilter.value = '';
        barrerasFilter.value = '';
        añoFilter.value = '';
        mesFilter.value = '';

        // Realizar una nueva búsqueda sin filtros
        buscarDatos();
    });

    // Expansion tile - Acordeon
    accordions.forEach((accordion) => {
        accordion.addEventListener('click', function () {
            const panel = this.nextElementSibling;
            const arrow = this.querySelectorAll('.material-icons')[1]; // Seleccionamos el segundo icono (flecha)
    
            // Si el panel ya está abierto, lo cerramos
            if (panel.classList.contains('open')) {
                panel.style.maxHeight = null;
                panel.classList.remove('open');
                this.classList.remove('active'); // Opcional: Remueve la clase activa
                arrow.classList.remove('rotate'); // Quita la rotación de la flecha
            } else {
                // Si el panel no está abierto, lo abrimos
                panel.style.maxHeight = panel.scrollHeight + "px"; // Establece la altura máxima para mostrar el contenido
                panel.classList.add('open');
                this.classList.add('active'); // Opcional: Añade clase activa al acordeón
                arrow.classList.add('rotate'); // Añade la clase que rota la flecha
            }
        });
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

    // obtener filtros
    fetch("php/obtener_filtros.php")
        .then(response => response.json())
        .then(data => {
            // Llenar las zonas
            if (data && data.zonas && data.zonas.length > 0) {
                const zonaFilter = document.getElementById('zona_filter'); // Asegúrate de tener el select para las zonas
                zonaFilter.innerHTML = '<option value="">Todos</option>';  // Asegúrate de tener la opción "Todos"

                data.zonas.forEach(zona => {
                    const option = document.createElement("option");
                    option.value = zona.id;  // El valor de la opción será el ID de la zona
                    option.textContent = zona.zona;  // El texto visible será el nombre de la zona
                    zonaFilter.appendChild(option);  // Añadir la opción al select
                });
            } else {
                console.error("No se recibieron zonas.");
            }

            // Llenar los tipos de discapacidad
            if (data && data.tipos_discapacidad && data.tipos_discapacidad.length > 0) {
                const discapacidadFilter = document.getElementById('discapacidad_filter'); // Asegúrate de tener el select para los tipos de discapacidad
                discapacidadFilter.innerHTML = '<option value="">Todos</option>';  // Asegúrate de tener la opción "Todos"

                data.tipos_discapacidad.forEach(discapacidad => {
                    const option = document.createElement("option");
                    option.value = discapacidad.id;  // El valor de la opción será el ID del tipo de discapacidad
                    option.textContent = discapacidad.discapacidad;  // El texto visible será el nombre del tipo de discapacidad
                    discapacidadFilter.appendChild(option);  // Añadir la opción al select
                });
            } else {
                console.error("No se recibieron tipos de discapacidad.");
            }

            // Llenar los valores de la tabla 'valores'
            if (data && data.valores && data.valores.length > 0) {
                const valores = data.valores; // Datos completos de la tabla 'valores'

                // Crear opciones para cada filtro utilizando los mismos datos
                const crearOpciones = (selectId) => {
                    const selectElement = document.getElementById(selectId);
                    selectElement.innerHTML = '<option value="">Todos</option>'; // Opción "Todos"

                    valores.forEach(fila => {
                        const option = document.createElement("option");
                        option.value = fila.id; // Usamos el ID de la fila como valor
                        option.textContent = fila.nombre || fila.valor; // Ajustar según las columnas de tu tabla
                        selectElement.appendChild(option);
                    });
                };

                // Aplicar a todos los filtros
                crearOpciones('higiene_filter');
                crearOpciones('iluminacion_filter');
                crearOpciones('ventilacion_filter');
                crearOpciones('orden_filter');
                crearOpciones('barreras_filter');

                console.log("Filtros cargados correctamente.");
            } else {
                console.error("No se recibieron datos de valores.");
            }

             // Verificar que la respuesta contenga datos
            if (data && data.años_disponibles && data.años_disponibles.length > 0) {
                const añoFilter = document.getElementById('año_filter');
                añoFilter.innerHTML = '<option value="">Todos</option>';
                data.años_disponibles.forEach(año => {
                    const option = document.createElement("option");
                    option.value = año; 
                    option.textContent = año;  
                    añoFilter.appendChild(option);
                });
            }
        })
        .catch(error => console.error("Error al cargar los filtros:", error));

    

    // Inicializar búsqueda al cargar la página
    buscarDatos();
});
