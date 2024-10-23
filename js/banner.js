// Efecto de parallax basado en el movimiento del ratón
const banner = document.getElementById('banner');

// Efecto de desenfoque al hacer scroll
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    const body = document.body;

    if (scrollY > 375) { // Cambia a 150px para empezar el efecto de desenfoque
        body.classList.add('scrolled');
    } else {
        body.classList.remove('scrolled');
    }
});

// Función para abrir el popup
function openPopup(titulo, descripcion, imgurl, id) {
    // Establecer el título del popup según el ID
    const popupTitle = (id === '1' || id === 1) ? 'Editar Banner' : 'Editar Noticias';
    document.getElementById('titulo-popup').innerText = popupTitle;
    
    document.getElementById('titulo').value = titulo;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('imgurl').value = imgurl;
    document.getElementById('id_noticia').value = id;
    document.getElementById('popup_edit_home').style.display = 'flex';
    document.getElementById('overlay').style.display = 'block'; // Mostrar el overlay
}

// Función para cerrar el popup
function closePopup() {
    document.getElementById('popup_edit_home').style.display = 'none';
    document.getElementById('overlay').style.display = 'none'; // Ocultar el overlay
}


// Asignar evento a todos los botones de edición para abrir el popup
// Esta parte es opcional si ya estás usando la función con parámetros
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        // Extrae los datos del botón (puedes ajustar estos valores según tu HTML)
        const titulo = this.getAttribute('data-titulo');
        const descripcion = this.getAttribute('data-descripcion');
        const imgurl = this.getAttribute('data-imgurl');
        const id = this.getAttribute('data-id');

        // Llama a la función openPopup con los valores obtenidos
        openPopup(titulo, descripcion, imgurl, id);
    });
});
