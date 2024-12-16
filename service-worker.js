const CACHE_NAME = 'v1'; // Nombre de la caché
const URLS_TO_CACHE = [
  '/index.php',
  '/about.php',
  '/cuentas.php',
  '/footer.html',
  '/formulario_discapacidad.php',
  '/graficos.php',
  '/navbar.php',
  '/registro.php',
  '/tabla_formulario.php',
  '/tabla_registro.php',
  'img/logo_accesibilidad_ok.png',
  'img/favicon.png',
  'css/estilos.css',
  'js/navbar.js',
  'js/about.js',
  'js/banner.js',
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

// Evento de instalación
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('Archivos en caché correctamente.');
      return cache.addAll(URLS_TO_CACHE);
    })
  );
});

// Evento de activación: eliminar cachés viejas
self.addEventListener('activate', (event) => {
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
});

// Interceptar solicitudes
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      if (response) {
        console.log('Retornando desde caché:', event.request.url);
        return response;
      }
      console.log('Realizando solicitud de red:', event.request.url);
      return fetch(event.request);
    })
  );
});
