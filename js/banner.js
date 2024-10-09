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
