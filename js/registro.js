// Función para mostrar u ocultar los campos adicionales
function mostrarCampos() {
    var seleccion = document.getElementById("persona_discapacidad").value;
    var extraFields = document.getElementById("extra-fields");
    var otrosParentescoField = document.getElementById("otros_parentesco");
    var direccionInput = document.getElementById("direccion");
    var certificadoSelect = document.getElementById("certificado_discapacidad");

    // Inicializar el campo "otros" como no visible
    otrosParentescoField.style.display = "none"; // Ocultar el campo "otros"
    extraFields.style.display = "none"; // Ocultar campos adicionales por defecto

    // Mostrar u ocultar campos adicionales según la selección
    if (seleccion === "Si") {
        extraFields.style.display = "block";

        // Establecer los campos como requeridos
        direccionInput.setAttribute("required", "required");
        certificadoSelect.setAttribute("required", "required");
    } else {
        // Quitar la obligación de los campos
        direccionInput.removeAttribute("required");
        certificadoSelect.removeAttribute("required");
    }

    // Añadir event listener para cambios en los checkboxes
    document.querySelectorAll('input[name="quien_es[]"]').forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            // Mostrar el campo "Otros" solo si está marcado
            if (this.value === "Otros") {
                if (this.checked) {
                    otrosParentescoField.style.display = "block";
                    otrosParentescoField.setAttribute("required", "required"); // Hace que sea obligatorio
                } else {
                    otrosParentescoField.style.display = "none";
                    otrosParentescoField.removeAttribute("required"); // Quita la obligación
                }
            }
        });
    });
}

// Llamar a la función cuando la página cargue para inicializar correctamente
window.onload = mostrarCampos;
