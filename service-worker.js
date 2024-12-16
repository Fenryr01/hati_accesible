const CACHE_NAME = 'v1.2'; // Cambia este número cada vez que quieras actualizar la caché

// Archivos estáticos a cachear
const STATIC_URLS_TO_CACHE = [
  '/index.php',
  '/about.php',
  '/footer.html',
  'img/logo_accesibilidad_ok.png',
  'img/favicon.png',
  'css/estilos.css',
  'js/about.js',
  'js/banner.js',
];

// Todos los demás recursos son dinámicos
const DYNAMIC_URLS_TO_CACHE = [
  '/cuentas.php',
  '/formulario_discapacidad.php',
  '/graficos.php',
  '/navbar.php',
  '/registro.php',
  '/tabla_formulario.php',
  '/tabla_registro.php',
  'js/navbar.js',
  'js/confirmacion.js',
  'js/envio_registo.js',
  'js/familia.js',
  'js/footer.js',
  'js/formulario.js',
  'js/registro.js',
  'php/con_home.php',
  'php/con_about.php',
  'php/db.php',
  'php/insertar_discapacidad.php',
  'php/login.php',
  'php/obtener_detalles.php',
  'php/registro_discapacidad.php',
  'php/salir.php',
  'php/get_valor.php',
];

// Evento de instalación: almacenar archivos estáticos en caché
self.addEventListener('install', (event) => {
  console.log('Service Worker: Instalando...');
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('Archivos estáticos en caché correctamente.');
      return cache.addAll(STATIC_URLS_TO_CACHE);
    })
  );
});

// Evento de activación: eliminar cachés antiguas
self.addEventListener('activate', (event) => {
  console.log('Service Worker: Activado.');
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            console.log('Eliminando caché vieja:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  return self.clients.claim();
});

// Interceptar solicitudes
self.addEventListener('fetch', (event) => {
  // Si la solicitud es para un recurso estático
  if (STATIC_URLS_TO_CACHE.includes(new URL(event.request.url).pathname)) {
    event.respondWith(
      caches.match(event.request).then((cachedResponse) => {
        if (cachedResponse) {
          console.log('Recurso estático encontrado en caché:', event.request.url);
          return cachedResponse; // Devuelve el recurso desde caché
        }

        // Si no está en caché, realiza la solicitud de red
        return fetch(event.request).then((networkResponse) => {
          if (networkResponse && networkResponse.ok) {
            caches.open(CACHE_NAME).then((cache) => {
              cache.put(event.request, networkResponse.clone()); // Actualiza el caché
            });
          }
          return networkResponse;
        });
      })
    );
  } else {
    // Si la solicitud es para un recurso dinámico (network-first)
    event.respondWith(
      fetch(event.request)
        .then((networkResponse) => {
          if (networkResponse && networkResponse.ok) {
            caches.open(CACHE_NAME).then((cache) => {
              // Solo clonamos la respuesta si no hemos usado el cuerpo
              cache.put(event.request, networkResponse.clone()); // Cachea la respuesta
            });
          }
          return networkResponse;
        })
        .catch(() => {
          // Si la red falla, devuelve el recurso desde caché si está disponible
          console.log('Fallo en la red, retornando desde caché:', event.request.url);
          return caches.match(event.request).then((cacheResponse) => {
            // Si no está en caché, redirige a la página principal
            return cacheResponse || caches.match('/index.php');
          });
        })
    );
  }
});
