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

function cambiarPagina(numeroPagina) {
    // Primero, restablecemos el color de todos los textos
    document.getElementById('datos_personales').style.color = '';
    document.getElementById('datos_vivienda').style.color = '';
    document.getElementById('datos_salud').style.color = '';

    // Luego, cambiamos el color del texto según la página actual
    if (numeroPagina === 1) {
        document.getElementById('datos_personales').style.color = '#0167ff';
    } else if (numeroPagina === 2) {
        document.getElementById('datos_vivienda').style.color = '#0167ff';
    } else if (numeroPagina === 3) {
        document.getElementById('datos_salud').style.color = '#0167ff';
    }

    // Aquí también se puede agregar la lógica para mostrar/ocultar las secciones del formulario
    mostrarPagina(numeroPagina);
}

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