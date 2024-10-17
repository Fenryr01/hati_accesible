
// Función para mostrar el popup de confirmación
function confirmarEliminacion(nombre, apellido) {
    return confirm(`¿Está seguro que desea eliminar el registro de ${nombre} ${apellido}?`);
}


function toggleOtrosField(checkbox) {
    const otrosField = document.getElementById("otros_parentesco");
    if (checkbox.checked) {
        otrosField.style.display = "block";
    } else {
        otrosField.style.display = "none";
    }
}
