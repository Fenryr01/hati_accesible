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
                    <input type="text" name="escolaridad_${i}" required><br>

                    <label>¿Tiene trabajo?</label>
                    <select name="trabajo_${i}" required>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select><br>

                    <label>¿Dónde trabaja?</label>
                    <input type="text" name="donde_${i}" required><br>
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
            <input type="text" id="elementos_confort_${i}" name="elementos_confort[]" required>
            <hr>
        `;
    }
}

function updateDiscapacidadInputs() {
    const cantidad = document.getElementById('numero_discapacidades').value;
    const contenedor = document.getElementById('discapacidad_inputs');
    contenedor.innerHTML = ''; // Limpiar entradas anteriores

    // Generar los inputs según el número de discapacidades
    for (let i = 0; i < cantidad; i++) {
        contenedor.innerHTML += `
            <h4>Discapacidad ${i + 1}</h4>
            <input type="text" id="discapacidad_${i}" name="discapacidad[]" placeholder="Ingrese discapacidad ${i + 1}" required>
            <hr>
        `;
    }
}
