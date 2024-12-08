document.addEventListener("DOMContentLoaded", function() {
    // Seleccionamos el input donde el usuario ingresa el número de miembros
    const inputMiembros = document.getElementById("miembros_grupo_familiar");
    

 
    // Si el valor de miembros ya está definido, generamos los campos al cargar la página
    generarCampos(inputMiembros.value);

    // Agregamos un evento que detecta cuando el valor del input cambia
    inputMiembros.addEventListener("input", function() {
        generarCampos(inputMiembros.value);
    });

    function generarCampos(numeroMiembros) {
        
        const contenedor = document.getElementById("grupo_familiar_container");
        

        // Limpiamos el contenedor por si ya tiene campos previos
        contenedor.innerHTML = '';

        // Validamos que el valor ingresado sea un número mayor a 0
        if (numeroMiembros > 0) {
            // Generamos los campos dinámicos para cada miembro
            for (let i = 1; i <= numeroMiembros; i++) {
                // Creamos un div para cada miembro
                let miembroDiv = document.createElement('div');
                miembroDiv.className = 'miembro_familiar';

                // Verificar si hay datos para este miembro
                const miembro = miembrosFamiliares[i - 1] || {};  // Obtener datos de PHP (si existen)
                const quien = miembro.quien || '';
                const nacimiento = miembro.nacimiento || '';
                const escolaridad = miembro.escolaridad || '';
                const trabajo = miembro.trabajo || '';
                const donde = miembro.donde || '';

                miembroDiv.innerHTML = `
                    <h4>Miembro ${i}</h4>
                    <label>¿Quién es?<span class="obligatorio">*</span></label>
                    <input type="text" name="quien_${i}" value="${quien}" required><br>

                    <label>Fecha de Nacimiento<span class="obligatorio">*</span></label>
                    <input type="date" id="nacimiento_${i}" name="nacimiento_${i}" value="${nacimiento}" required><br>

                    <label>Edad</label>
                    <input type="number" id="edad_${i}" name="edad_${i}" disabled><br>

                    <label>Escolaridad<span class="obligatorio">*</span></label>
                    <select name="escolaridad_${i}" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1" ${escolaridad === '1' ? 'selected' : ''}>Si</option>
                        <option value="0" ${escolaridad === '0' ? 'selected' : ''}>No</option>
                    </select><br>

                    <label>¿Tiene trabajo?<span class="obligatorio">*</span></label>
                    <select name="trabajo_${i}" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1" ${trabajo === '1' ? 'selected' : ''}>Si</option>
                        <option value="0" ${trabajo === '0' ? 'selected' : ''}>No</option>
                    </select><br>

                    <label>¿Dónde trabaja?</label>
                    <input type="text" name="donde_${i}" value="${donde}"><br>
                    <hr>
                `;

                // Añadimos el div al contenedor
                contenedor.appendChild(miembroDiv);

                // Solo calcular la edad para los miembros
                const nacimientoInput = document.getElementById(`nacimiento_${i}`);
                const edadInput = document.getElementById(`edad_${i}`);

                // Función para calcular la edad
                const calcularEdad = () => {
                    const fechaNacimiento = new Date(nacimientoInput.value);
                    const hoy = new Date();
                    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                    const mes = hoy.getMonth() - fechaNacimiento.getMonth();

                    // Ajuste si la fecha de nacimiento aún no ha ocurrido en el año actual
                    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                        edad--;
                    }

                    // Actualizamos el valor del campo de edad
                    edadInput.value = edad;
                };

                // Llamar a calcularEdad cuando se cambie el valor
                nacimientoInput.addEventListener('change', calcularEdad);

                // Llamar a calcularEdad al cargar la página, para el valor autocompletado
                if (nacimientoInput.value) {
                    calcularEdad();
                }
            }
        }
    }
});

// Función para agregar el cálculo de edad basado en la fecha de nacimiento
function agregarCalculoEdad() {
    const nacimientoInput = document.getElementById('nacimiento');
    const edadInput = document.getElementById('edad');

    // Función para calcular la edad
    const calcularEdad = () => {
        const fechaNacimiento = new Date(nacimientoInput.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mes = hoy.getMonth() - fechaNacimiento.getMonth();

        // Ajuste si la fecha de nacimiento aún no ha ocurrido en el año actual
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            edad--;
        }

        // Actualizamos el valor del campo de edad
        edadInput.value = edad;
    };

    // Llamar a calcularEdad cuando se cambie el valor
    nacimientoInput.addEventListener('change', calcularEdad);

    // Llamar a calcularEdad al cargar la página, para el valor autocompletado
    if (nacimientoInput.value) {
        calcularEdad();
    }
}

// Llamar a la función para inicializar el cálculo de edad
agregarCalculoEdad();

/// Función para mostrar y actualizar los inputs de uso de ambientes
function mostrarUsoAmbientes(numeroAmbientes) {
    const contenedor = document.getElementById('contenedorUsoAmbientes');
    numeroAmbientes = parseInt(numeroAmbientes) || 0; // Asegurar que sea un número
    contenedor.innerHTML = ''; // Limpiar el contenedor antes de generar nuevos inputs

    // Generar los inputs según el número de ambientes indicado
    for (let i = 0; i < numeroAmbientes; i++) {
        const valorExistente = UsoAmbientes[i] || '';  
        contenedor.innerHTML += `
            <h4>Uso del Ambiente ${i + 1}</h4>
            <input type="text" id="uso_ambiente_${i}" name="uso_ambiente[]" value="${valorExistente}" required>
            <hr>
        `;
    }
}

// Cargar datos iniciales al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    // Llamar a la función con el valor de numeroAmbientes ya cargado desde PHP
    mostrarUsoAmbientes(numeroAmbientes);
});



async function mostrarZonas() {
    const selectZonas = document.getElementById('zona');
    
    try {
        // Obtener las zonas desde PHP usando fetch
        const response = await fetch('php/get_valor.php');
        const datos = await response.json();

        // Llenar el select con las zonas obtenidas
        const zonas = datos.zonas;

        zonas.forEach(zona => {
            const option = document.createElement('option');
            option.value = zona.id; // Asignar el ID como valor
            option.textContent = zona.zona; // Usar el nombre de la zona como texto
            selectZonas.appendChild(option); // Agregar la opción al select
        });

        // Seleccionar la zona automáticamente si la variable PHP $zona tiene valor
        if (zonaSeleccionada) {
            selectZonas.value = zonaSeleccionada;
        }

    } catch (error) {
        console.error('Error al obtener zonas:', error);
    }
}

// Llamar a la función para mostrar zonas al cargar la página
document.addEventListener('DOMContentLoaded', mostrarZonas);



async function mostrarElementosConfort(numeroConfort) {
    const contenedor = document.getElementById('contenedorElementosConfort');
    contenedor.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos campos

    if (numeroConfort > 0) {
        try {
            // Obtener las opciones de los elementos de confort desde `get_valor.php`
            const response = await fetch('php/get_valor.php');
            const datos = await response.json();

            const opcionesConfort = datos.elementos_confort; // Opciones de los selects
            const valoresSeleccionados = elementos_confort; // Valores pasados por el PHP

            for (let i = 0; i < numeroConfort; i++) {
                let selectOptions = `<option value="" disabled selected>Seleccione una opción</option>`;

                // Crear las opciones para el select
                opcionesConfort.forEach(elemento => {
                    const isSelected = valoresSeleccionados[i] === elemento.id ? 'selected' : '';
                    selectOptions += `<option value="${elemento.id}" ${isSelected}>${elemento.cual_elemento}</option>`;
                });

                contenedor.innerHTML += `
                    <h4>Elemento de Confort ${i + 1}</h4>
                    <select id="elementos_confort_${i}" name="elementos_confort[]" required>
                        ${selectOptions}
                    </select>
                    <hr>
                `;
            }
        } catch (error) {
            console.error('Error al obtener las opciones de confort:', error);
        }
    }
}
document.addEventListener('DOMContentLoaded', () => {
    mostrarElementosConfort(numeroConfort);
});



async function updateDiscapacidadInputs() {
    const cantidad = parseInt(document.getElementById('numero_discapacidades').value, 10); // Convertir a número
    const contenedor = document.getElementById('discapacidad_inputs');
    contenedor.innerHTML = ''; // Limpiar entradas anteriores

    if (cantidad > 0) {
        try {
            // Obtener los tipos de discapacidad desde PHP usando fetch
            const response = await fetch('php/get_valor.php');
            if (!response.ok) throw new Error('Error al obtener los datos de discapacidad');
            const data = await response.json();
            const tiposDiscapacidad = data.tipos_discapacidad; // Array de objetos [{ id, cual_discapacidad }]

            // Iterar para generar los inputs dinámicos
            for (let i = 0; i < cantidad; i++) {
                let selectOptions = `<option value="" disabled selected>Seleccione tipo de discapacidad</option>`;
                
                // Autocompletar según discapacidadesSeleccionadas si está definido
                const selectedValue =
                    discapacidadesSeleccionadas?.[i]?.tipo_discapacidad || '';
                const inputValue =
                    discapacidadesSeleccionadas?.[i]?.discapacidad || '';

                // Crear las opciones del select
                tiposDiscapacidad.forEach(discapacidad => {
                    const isSelected = discapacidad.id == selectedValue ? 'selected' : '';
                    selectOptions += `<option value="${discapacidad.id}" ${isSelected}>${discapacidad.cual_discapacidad}</option>`;
                });

                // Agregar los elementos al contenedor
                contenedor.innerHTML += `
                    <h4>Discapacidad ${i + 1}</h4>
                    <select id="tipo_discapacidad_${i}" name="tipo_discapacidad[]" required>
                        ${selectOptions}
                    </select>
                    <input type="text" id="discapacidad_${i}" name="discapacidad[]" placeholder="Discapacidad específica" value="${inputValue}" required>
                    <hr>
                `;
            }
        } catch (error) {
            console.error('Error al generar los campos:', error);
        }
    }
}

// Llamar a la función cuando se cambie el valor del input número
document.addEventListener('DOMContentLoaded', updateDiscapacidadInputs);



async function mostrarValores() {
    try {
        // Obtener los valores desde PHP
        const response = await fetch('php/get_valor.php');
        
        // Verificar que la respuesta sea exitosa
        if (!response.ok) {
            throw new Error('Error en la red: ' + response.statusText);
        }

        const data = await response.json();

        // Obtener los valores
        const valores = data.valores; // Asegúrate de que 'valores' contenga los datos

        // Función para llenar un select
        const llenarSelect = (idSelect) => {
            const select = document.getElementById(idSelect);
            valores.forEach(valor => {
                const option = document.createElement('option');
                option.value = valor.id; // Asignar el ID como valor
                option.textContent = valor.valor; // Usar el valor como texto
                select.appendChild(option); // Agregar la opción al select
            });
        };

        // Llenar cada select
        llenarSelect('ventilacion');
        llenarSelect('iluminacion');
        llenarSelect('higiene');
        llenarSelect('orden');
        llenarSelect('barreras_arquitectonicas');

        // Seleccionar la opción automáticamente si la variable PHP $ tienen valor
        const selectVentilacion = document.getElementById('ventilacion');
        if (ventilacionSeleccionada) {
            selectVentilacion.value = ventilacionSeleccionada;
        }

        const selectIluminacion = document.getElementById('iluminacion');
        if (iluminacionSeleccionada) {
            selectIluminacion.value = iluminacionSeleccionada;
        }

        const selectHigiene = document.getElementById('higiene');
        if (higieneSeleccionada) {
            selectHigiene.value = higieneSeleccionada;
        }

        const selectOrden = document.getElementById('orden');
        if (ordenSeleccionada) {
            selectOrden.value = ordenSeleccionada;
        }

        const selectBarrerasArquitectonicas = document.getElementById('barreras_arquitectonicas');
        if (barreras_arquitectonicasSeleccionada) {
            selectBarrerasArquitectonicas.value = barreras_arquitectonicasSeleccionada;
        }



    } catch (error) {
        console.error('Error al obtener valores:', error);
    }
}

// Llamar a la función para mostrar los valores al cargar la página
document.addEventListener('DOMContentLoaded', mostrarValores);




function validarFormulario(pagina) {
    // Selecciona todos los inputs y selects en la página específica
    const elementos = document.querySelectorAll(`#pagina${pagina} input, #pagina${pagina} select`);
    let formularioValido = true;

    for (let elemento of elementos) {
        // Limpia cualquier mensaje previo de error personalizado
        elemento.setCustomValidity('');

        if (!elemento.value.trim()) {
            // Si el campo es requerido y está vacío
            if (elemento.hasAttribute('required')) {
                formularioValido = false;
                elemento.setCustomValidity('Este campo es requerido.');
                elemento.reportValidity();
                break; // Detén el ciclo en el primer error encontrado
            }
        } else if (!elemento.checkValidity()) {
            // Si el campo tiene un valor pero no pasa las validaciones del navegador
            formularioValido = false;
            elemento.reportValidity();
            break; // Detén el ciclo en el primer error encontrado
        }
    }

    return formularioValido; // Solo pasa a la siguiente página si todos los campos son válidos
}



function cambiarPagina(nuevaPagina) {
    // Validación de la página actual antes de cambiar a la nueva página
    const paginaActual = document.querySelector('.pagina:not([style*="display: none"])');
    const numeroPaginaActual = parseInt(paginaActual.id.replace('pagina', ''));

    // Si vamos a una página siguiente, validamos los campos requeridos
    if (nuevaPagina > numeroPaginaActual && !validarFormulario(numeroPaginaActual)) {
       return;  // Si la validación falla, detenemos el cambio de página
    }

    // Ocultamos la página actual
    paginaActual.style.display = 'none';

    // Mostramos la nueva página
    const nuevaPaginaElemento = document.getElementById(`pagina${nuevaPagina}`);
    nuevaPaginaElemento.style.display = 'block';

    // Ahora, cambiamos el color del texto según la página actual
    document.getElementById('datos_personales').style.color = '';
    document.getElementById('datos_vivienda').style.color = '';
    document.getElementById('datos_salud').style.color = '';

    if (nuevaPagina === 1) {
        document.getElementById('datos_personales').style.color = '#0167ff';
    } else if (nuevaPagina === 2) {
        document.getElementById('datos_vivienda').style.color = '#0167ff';
    } else if (nuevaPagina === 3) {
        document.getElementById('datos_salud').style.color = '#0167ff';
    }
}


// Seleccionamos el campo de fecha y el campo de edad
const nacimientoInput = document.getElementById('nacimiento');
const edadInput = document.getElementById('edad');

// Función para calcular la edad a partir de la fecha de nacimiento
nacimientoInput.addEventListener('change', function () {
    const fechaNacimiento = new Date(this.value);
    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();

    // Ajuste si la fecha de nacimiento aún no ha ocurrido en el año actual
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }

    // Actualizamos el valor del campo de edad
    edadInput.value = edad;
});



function mostrarPagina(numeroPagina) {
    // Esconde todas las páginas primero
    document.getElementById('pagina1').style.display = 'none';
    document.getElementById('pagina2').style.display = 'none';
    document.getElementById('pagina3').style.display = 'none';

    // Muestra solo la página correspondiente
    document.getElementById('pagina' + numeroPagina).style.display = 'block';
}

// Mostrar la primera página al cargar el formulario
window.onload = function() {
    cambiarPagina(1);
};