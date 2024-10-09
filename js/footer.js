// Obtener elementos del DOM
var modal = document.getElementById("loginModal");
var btn = document.getElementById("loginBtn");
var span = document.getElementsByClassName("close")[0];

// Abrir el modal al hacer clic en el favicon
btn.onclick = function() {
    modal.style.visibility = "visible";
}

// Cerrar el modal al hacer clic en la "X"
span.onclick = function() {
    modal.style.visibility = "hidden";
}

