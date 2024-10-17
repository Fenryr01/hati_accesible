document.addEventListener("DOMContentLoaded", function() {
    // Seleccionamos el input donde el usuario ingresa el número de miembros
    const inputMiembros = document.getElementById("miembros_grupo_familiar");

    // Agregamos un evento que detecta cuando el valor del input cambia
    inputMiembros.addEventListener("input", generarCampos);

    function generarCampos() {
        // Obtenemos el número de miembros ingresado por el usuario
        const numeroMiembros = inputMiembros.value;
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
                miembroDiv.innerHTML = `
                    <h4>Miembro ${i}</h4>
                    <label>¿Quién es?</label>
                    <input type="text" name="quien_${i}" required><br>

                    <label>Edad</label>
                    <input type="number" name="edad_${i}" required><br>

                    <label>Escolaridad</label>
                    <select name="escolaridad_${i}" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select><br>

                    <label>¿Tiene trabajo?</label>
                    <select name="trabajo_${i}" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select><br>

                    <label>¿Dónde trabaja?</label>
                    <input type="text" name="donde_${i}"><br>
                    <hr>
                `;
                // Añadimos el div al contenedor
                contenedor.appendChild(miembroDiv);
            }
        }
    }
});

function mostrarUsoAmbientes(numeroAmbientes) {
    const contenedor = document.getElementById('contenedorUsoAmbientes');
    contenedor.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos campos

    for (let i = 0; i < numeroAmbientes; i++) {
        contenedor.innerHTML += `
            <h4>Uso del Ambiente ${i + 1}</h4>
            <input type="text" id="uso_ambiente_${i}" name="uso_ambiente[]" required>
            <hr>
        `;
    }
}

function mostrarElementosConfort(numeroConfort) {
    const contenedor = document.getElementById('contenedorElementosConfort');
    contenedor.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos campos

    for (let i = 0; i < numeroConfort; i++) {
        contenedor.innerHTML += `
            <h4>Elemento de Confort ${i + 1}</h4>
            <select id="elementos_confort_${i}" name="elementos_confort[]" required>
                <option value="" disabled selected>Seleccione una opción</option>
                <option value="internet">Internet</option>
                <option value="celular">Celular</option>
                <option value="tv">TV</option>
                <option value="heladera">Heladera</option>
                <option value="cocina">Cocina</option>
                <option value="lavarropas">Lavarropas</option>
                <option value="playstation">PlayStation</option>
                <option value="otros">Otros</option>
            </select>
            <hr>
        `;
    }
}

function updateDiscapacidadInputs() {
    const cantidad = document.getElementById('numero_discapacidades').value;
    const contenedor = document.getElementById('discapacidad_inputs');
    contenedor.innerHTML = ''; // Limpiar entradas anteriores

    // Generar los selects e inputs según el número de discapacidades
    for (let i = 0; i < cantidad; i++) {
        contenedor.innerHTML += `
            <h4>Discapacidad ${i + 1}</h4>
            <select id="tipo_discapacidad_${i}" name="tipo_discapacidad[]" required>
                <option value="" disabled selected>Seleccione tipo de discapacidad</option>
                <option value="auditiva">Auditiva</option>
                <option value="visual">Visual</option>
                <option value="visceral">Visceral</option>
                <option value="mental">Mental</option>
                <option value="motora">Motora</option>
                <option value="congenita">Congénita</option>
                <option value="cea">CEA (Condición del Espectro Autista)</option>
                <option value="trastorno_procesamiento_sensorial">Trastorno del procesamiento sensorial</option>
            </select>
            <input type="text" id="discapacidad_${i}" name="discapacidad[]" placeholder="Discapacidad específica" required>
            <hr>
        `;
    }
}
function validarFormulario(pagina) {
    const inputsRequeridos = document.querySelectorAll(`#pagina${pagina} [required]`);
    let todosCompletos = true; 

    for (let input of inputsRequeridos) {
        if (!input.value) {
            todosCompletos = false; 
            input.setCustomValidity('Este campo es requerido.'); 
        } else {
            input.setCustomValidity(''); 
        }
    }

    // Validar el formulario
    if (!todosCompletos) {
        inputsRequeridos.forEach(input => {
            input.reportValidity(); 
        });
        return false; 
    }

    return true;
}

function cambiarPagina(nuevaPagina) {
    const paginaActual = document.querySelector('.pagina:not([style*="display: none"])');
    const numeroPaginaActual = parseInt(paginaActual.id.replace('pagina', ''));

    if (nuevaPagina > numeroPaginaActual && !validarFormulario(numeroPaginaActual)) {
        return; // Detiene si la validación falla
    }

    // Ocultar la página actual
    paginaActual.style.display = 'none';
    
    // Mostrar la nueva página
    const nuevaPaginaElemento = document.getElementById(`pagina${nuevaPagina}`);
    nuevaPaginaElemento.style.display = 'block';
}
