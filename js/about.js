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
