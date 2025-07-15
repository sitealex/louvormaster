const CACHE_NAME = 'louvormaster-v1';
const ASSETS_TO_CACHE = [
    '/',
    '/index.php',
    '/css/style.css',
    '/js/app.js',
    '/js/db.js',
    '/js/sync.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                return cache.addAll(ASSETS_TO_CACHE);
            })
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;
    
    event.respondWith(
        caches.match(event.request)
            .then((response) => {
                // Retorna do cache se encontrado, senão faz a requisição
                return response || fetch(event.request)
                    .then((response) => {
                        // Se for uma requisição para nossa API, não cacheamos
                        if (event.request.url.includes('/api/')) {
                            return response;
                        }
                        
                        // Caso contrário, adiciona ao cache para uso offline
                        const responseToCache = response.clone();
                        caches.open(CACHE_NAME)
                            .then((cache) => {
                                cache.put(event.request, responseToCache);
                            });
                        
                        return response;
                    })
                    .catch(() => {
                        // Se offline e não encontrado no cache, retorna uma página offline
                        if (event.request.headers.get('accept').includes('text/html')) {
                            return caches.match('/offline.html');
                        }
                    });
            })
    );
});

self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Atualização em segundo plano
self.addEventListener('sync', (event) => {
    if (event.tag === 'sync-data') {
        event.waitUntil(
            syncData()
                .then(() => {
                    console.log('Sincronização em segundo plano concluída');
                    return Promise.resolve();
                })
                .catch((error) => {
                    console.error('Erro na sincronização em segundo plano:', error);
                    return Promise.reject();
                })
        );
    }
});