// Función para aplicar la clase en móviles y pantallas grandes
function updateNavbar() {
    var navbar = document.getElementById("navbar");
    var isMobile = window.innerWidth <= 768; 
    var isIndexPage = window.location.pathname.endsWith("index.php"); // Verifica si está en index.php

    if (isMobile || !isIndexPage) {
        // En móviles o si no estamos en index.php, siempre tiene la clase 'scrolled' para el color azul oscuro
        navbar.classList.add('scrolled');
        navbar.classList.remove('transparent');
    } else {
        // En pantallas más grandes, activa la clase 'scrolled' según el scroll
        if (window.scrollY > document.getElementById("banner").offsetHeight) {
            navbar.classList.add("scrolled");
            navbar.classList.remove("transparent");
        } else {
            navbar.classList.remove("scrolled");
            navbar.classList.add("transparent");
        }
    }
}

// Llama a la función al hacer scroll en pantallas grandes
window.addEventListener("scroll", function () {
    updateNavbar();
});

// Llama a la función al cargar la página
updateNavbar();

// Asegura que la navbar se actualice correctamente si se cambia el tamaño de la ventana
window.addEventListener("resize", function() {
    updateNavbar();
});

// Muestra/oculta el menú hamburguesa
const hamburger = document.querySelector('.navbar-toggle');
const navbarLinks = document.querySelector('.navbar-links');

hamburger.addEventListener('click', function() {
    navbarLinks.classList.toggle('active');
    document.querySelector('.navbar').classList.toggle('responsive');
});

// Función para manejar el clic en los botones de dropdown
function setupDropdown(btnId) {
    const dropdownBtn = document.getElementById(btnId);
    
    // Verificar si el botón existe
    if (!dropdownBtn) {
        console.error(`El botón con id '${btnId}' no existe en el DOM.`);
        return; // Salir de la función si no existe
    }

    const dropdownContent = dropdownBtn.parentElement.querySelector('.dropdown-content');

    // Verificar si el contenido del dropdown existe
    if (!dropdownContent) {
        console.error(`El contenido del dropdown para el botón con id '${btnId}' no existe.`);
        return;
    }

    // Manejar el clic en el botón de dropdown
    dropdownBtn.addEventListener('click', function(event) {
        event.stopPropagation(); // Evitar que el evento burbujee

        // Alternar la clase 'show' solo si estamos en pantalla pequeña
        if (window.innerWidth < 1250) {
            dropdownContent.classList.toggle('show');
        }
    });

    // Manejar clic en el botón con id 'loginBtn'
    const loginBtn = document.getElementById('loginBtn');
    if (loginBtn) {
        loginBtn.addEventListener('click', function() {
            navbarLinks.classList.toggle('active');
            document.querySelector('.navbar').classList.toggle('responsive');
        });
    } else {
        console.error("El botón con id 'loginBtn' no existe en el DOM.");
    }
    

    // Cerrar el dropdown si se hace clic fuera de él
    window.addEventListener('click', function() {
        if (window.innerWidth < 1250) {
            dropdownContent.classList.remove('show'); // Ocultar el dropdown
        }
    });

    // Evitar el cierre al hacer clic dentro del dropdown
    dropdownContent.addEventListener('click', function(event) {
        event.stopPropagation(); // Evitar que el clic burbujee al window
    });

    // Evitar el cierre si se hace clic en un enlace del dropdown
    const links = dropdownContent.querySelectorAll('a');
    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation(); // Evitar que el clic burbujee al window
        });
    });
}

// Configurar todos los dropdowns
setupDropdown('dropdownFormBtn');
setupDropdown('dropdownDataBtn');
setupDropdown('dropdownAccountBtn');

// Monitorear el tamaño de la ventana y ajustar el comportamiento de los dropdowns
window.addEventListener('resize', function() {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    dropdowns.forEach(function(dropdownContent) {
        dropdownContent.classList.remove('show'); // Ocultar todos los dropdowns al cambiar el tamaño
    });
});
