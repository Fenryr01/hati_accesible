document.addEventListener("DOMContentLoaded", () => {
    const menuItems = document.querySelectorAll(".content-menu li");
    const mainContent = document.querySelector(".main_general_grafico");

    // Selecciona el div donde se va a agregar el botón
    const buttonContainer = document.querySelector(".buton_grafico");

    // Crear un botón global para cambiar el tamaño y estilo de los gráficos
    const toggleSizeButton = document.createElement("button");
    toggleSizeButton.innerHTML = '<span class="material-icons">check_box_outline_blank</span>';

    // Agregar el botón dentro del contenedor .buton_grafico
    buttonContainer.appendChild(toggleSizeButton);

    let expanded = false;

    toggleSizeButton.addEventListener("click", () => {
        const graficoContainers = document.querySelectorAll(".grafico-container");

        // Alternar entre estilos de grid y una sola columna
        if (expanded) {
            mainContent.style.gridTemplateColumns = "repeat(auto-fill, minmax(500px, 1fr))";
            graficoContainers.forEach(container => {
                container.style.height = "400px"; 
                container.style.width = "100%";
            });
        } else {
            mainContent.style.gridTemplateColumns = "1fr"; 
            graficoContainers.forEach(container => {
                container.style.height = "550px"; 
            });
        }

        // Alternar texto del botón
        expanded = !expanded;
        toggleSizeButton.innerHTML = expanded ? '<span class="material-icons">widgets</span>' : '<span class="material-icons">check_box_outline_blank</span>';
    });

    const loadGrafico = (grafico, endpoint) => {
        mainContent.innerHTML = `<h2>Cargando...</h2>`;

        fetch(endpoint)
            .then(response => response.json())
            .then(data => {
                mainContent.innerHTML = ""; // Limpiar contenido previo

                if (data.error) {
                    mainContent.innerHTML = `<h2>Error: ${data.error}</h2>`;
                    return;
                }

                renderGraficosConTitulos(grafico, data);
            })
            .catch(error => {
                console.error("Error al cargar los gráficos:", error);
                mainContent.innerHTML = `<h2>Error al cargar los gráficos.</h2>`;
            });
    };

    const renderGraficosConTitulos = (grafico, data) => {
    // Limpiar contenido previo
    mainContent.innerHTML = "";

    // Lista de palabras clave para gráficos de barras agrupadas
    const palabrasClaveBarrasAgrupadas = [
        "de niveles por categoría",
        "discapacidad por rango de edades",
        "discapacidad por zonas"
    ];

    data.forEach(graf => {
        const section = document.createElement("section");
        const sanitizedTitle = graf.titulo.replace(/\s+/g, '-').toLowerCase(); // Sanitiza el título para usarlo en el id
        section.innerHTML = `
            <h1 id="titulo">${graf.titulo}</h1>
            <div id="${sanitizedTitle}" class="grafico-container" style="width: 100%;"></div>
        `;
        mainContent.appendChild(section);

        // Lógica de decisión mejorada
        const tituloNormalizado = graf.titulo.toLowerCase();
        if (palabrasClaveBarrasAgrupadas.some(keyword => tituloNormalizado.includes(keyword))) {
            crearGraficoBarrasAgrupadas(graf);
        } else if (tituloNormalizado.includes("zona")) {
            crearGraficoTorta(graf);
        } else {
            crearGraficoBarra(graf);
        }
    });
};


    const crearGraficoBarra = (grafico) => {
        // Función para dividir "Trastorno del procesamiento sensorial"
        const dividirEtiqueta = (texto) => {
            if (texto === "Trastorno del procesamiento sensorial") {
                return ["Trastorno", "del", "proc", "sensorial"];
            } else if (texto === "Barreras Arquitectónicas") {
                return ["Barreras", "Arquitectónicas"];
            }
            return texto; // Si no coincide, devuelve el texto original
        };
    
        // Modificar las categorías antes de pasarlas al gráfico
        const categoriasModificadas = (grafico.labels || grafico.categories).map(dividirEtiqueta);
    
        const options = {
            chart: {
                type: 'bar',
                height: '80%',
                toolbar: {
                    show: true,  // Habilitar la barra de herramientas
                    tools: {
                        download: true,  // Habilitar la opción de descarga
                    },
                    export: {
                        csv: {
                            filename: grafico.titulo,
                        },
                        svg: {
                            filename: grafico.titulo,
                        },
                        png: {
                            filename: grafico.titulo,
                        }
                    }
                }
            },
            series: [{
                name: grafico.titulo,
                data: grafico.data
            }],
            xaxis: {
                categories: categoriasModificadas,  // Usamos las categorías modificadas
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '12px',
                        fontWeight: 'bold',
                        fontFamily: 'Arial, sans-serif',
                    },
                },
            },
            dataLabels: {
                style: {
                    fontSize: '15px',
                    fontWeight: 'bold',
                },
            },
            plotOptions: {
                bar: {
                    distributed: true, 
                }
            },
            colors: [
                '#2980b9', '#1abc9c', '#e74c3c', '#9b59b6', '#f1c40f',
                '#d80000', '#5d4037', '#29b6f6', '#34495E', '#2C3E50',
                '#7F8C8D', '#BFC9CA', '#A52A2A', '#6C5B7B', '#9c640c',
                '#6d4c41', '#5b2c6f', '#922b21', '#73c6b6', '#3498db'
            ]
        };
    
        const chartContainer = document.querySelector(`#${grafico.titulo.replace(/\s+/g, '-').toLowerCase()}`);
        if (chartContainer) {
            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
    };
    

    const crearGraficoBarrasAgrupadas = (grafico) => {
        const dividirEtiqueta = (texto) => {
            if (texto === "Barreras Arquitectónicas") {
                return ["Barreras", "Arquitectónicas"]; 
            }
            return texto; // Si no es el texto que quieres dividir, lo devuelves tal cual
        };

        // Modificar las categorías antes de pasarlas al gráfico
        const categoriasModificadas = (grafico.labels || grafico.categories).map(dividirEtiqueta);

        const options = {
            chart: {
                type: 'bar',
                height: '80%',
                stacked: false,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    },
                    export: {
                        csv: {
                        filename: grafico.titulo,
                        },
                        svg: {
                        filename: grafico.titulo,
                        },
                        png: {
                        filename: grafico.titulo,
                        }
                    }
                }
            },
            series: grafico.series,  // Los datos de las barras agrupadas
            xaxis: {
                categories: categoriasModificadas,
                labels: {
                    rotate:0,
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                    }
                }
            },
            dataLabels: {
                enabled: false,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '65%',
                }
            },
            colors: [
                '#990000', '#ccb433', '#cc33cc', '#1974b0', '#4db34d',
                '#d80000', '#F39C12', '#29b6f6', '#34495E', '#2C3E50'
            ]
        };

        const chartContainer = document.querySelector(`#${grafico.titulo.replace(/\s+/g, '-').toLowerCase()}`);
        if (chartContainer) {
            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
    };

    const crearGraficoTorta = (grafico) => {
        const options = {
            chart: {
                type: 'pie',
                height: '80%',
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    },
                    export: {
                        csv: {
                            filename: grafico.titulo,
                        },
                        svg: {
                            filename: grafico.titulo,
                        },
                        png: {
                            filename: grafico.titulo,
                        }
                    }
                }
            },
            series: grafico.data,
            labels: grafico.categories,
            dataLabels: {
                style: {
                    fontSize: '15px',
                    fontWeight: 'bold',
                },
            },
            colors: [
                '#2980b9', '#1abc9c', '#e74c3c', '#9b59b6', '#f1c40f',
                '#d41212', '#5d4037', '#29b6f6', '#34495E', '#2C3E50',
                '#7F8C8D', '#BFC9CA', '#A52A2A', '#6C5B7B', '#9c640c',
                '#6d4c41', '#5b2c6f', '#922b21', '#73c6b6', '#3498db'
            ]
        };
    
        const chartContainer = document.querySelector(`#${grafico.titulo.replace(/\s+/g, '-').toLowerCase()}`);
        if (chartContainer) {
            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        }
    };


    menuItems.forEach((item) => {
        item.addEventListener("click", () => {
            // Eliminar la clase 'active' de todos los elementos
            menuItems.forEach((menuItem) => menuItem.classList.remove("active"));
    
            // Agregar la clase 'active' al elemento seleccionado
            item.classList.add("active");
    
            const grafico = item.getAttribute("data-grafico");
    
            let endpoint = "";
            switch (grafico) {
                case "general":
                    endpoint = "php/grafico_general.php";
                    break;
                case "salud":
                    endpoint = "php/grafico_salud.php";
                    break;
                case "vivienda":
                    endpoint = "php/grafico_vivienda.php";
                    break;
                case "todos":
                    endpoint = "php/grafico_todos.php";
                    break;
                default:
                    console.error("Endpoint no definido para el gráfico:", grafico);
                    return;
            }
    
            if (endpoint) {
                loadGrafico(grafico, endpoint);
            }
        });
    });

    if (menuItems.length > 0) {
        menuItems[0].click();
    }
});
