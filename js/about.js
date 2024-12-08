function openPopup(popupId) {
    // Mostrar el overlay y el popup correspondiente
    document.getElementById("overlay").style.display = "block";
    document.getElementById(popupId).style.display = "flex";
}

function closePopup(popupId = null) {
    // Ocultar el overlay
    document.getElementById("overlay").style.display = "none";

    if (popupId) {
        // Cerrar solo el popup específico
        document.getElementById(popupId).style.display = "none";
    } else {
        // Cerrar todos los popups
        const popups = document.querySelectorAll(".popup-overlay_home");
        popups.forEach(popup => popup.style.display = "none");
    }
}

function copiarAlPortapapeles(texto, evento) {
    // Crea un elemento de texto invisible
    var elemento = document.createElement('input');
    elemento.setAttribute('value', texto);
    document.body.appendChild(elemento);

    // Selecciona el texto dentro del elemento
    elemento.select();
    elemento.setSelectionRange(0, 99999); // Para dispositivos móviles

    // Copia el texto al portapapeles
    document.execCommand('copy');

    // Elimina el elemento del DOM
    document.body.removeChild(elemento);

    // Crear el mensaje de copiado
    var mensaje = document.createElement('div');
    mensaje.classList.add('mensaje-copiado');
    mensaje.innerText = '¡COPIADO!';

    // Obtener la posición del elemento clickeado
    var rect = evento.target.getBoundingClientRect();
    
    // Establecer la posición del mensaje cerca del elemento
    mensaje.style.position = 'absolute';
    mensaje.style.left = `${rect.left + window.scrollX + 10}px`;  // Ajusta la posición horizontal
    mensaje.style.top = `${rect.top + window.scrollY - 30}px`;    // Ajusta la posición vertical

    // Establecer más estilos para asegurar que sea visible
    mensaje.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    mensaje.style.color = 'white';
    mensaje.style.padding = '5px 10px';
    mensaje.style.borderRadius = '5px';
    mensaje.style.fontSize = '12px';
    mensaje.style.opacity = '1';
    mensaje.style.zIndex = '9999';
    mensaje.style.transition = 'opacity 0.3s ease';

    // Agregar el mensaje al cuerpo del documento
    document.body.appendChild(mensaje);

    // Mostrar el mensaje y hacer que desaparezca después de unos segundos
    setTimeout(function() {
        mensaje.style.opacity = '0';
        setTimeout(function() {
            mensaje.remove();
        }, 50);
    }, 1500); // El mensaje desaparecerá después de 1.5 segundos
}


