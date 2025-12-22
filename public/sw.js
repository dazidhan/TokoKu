const CACHE_NAME = 'tokoku-v2'; // Ganti versi jika ada update kode sw
const OFFLINE_URL = '/offline';

// 1. INSTALL: Simpan halaman offline ke dalam "Tas" (Cache) browser
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            // Kita simpan URL offline dan CDN Tailwind agar tampilan tetap bagus
            return cache.addAll([
                OFFLINE_URL,
                'https://cdn.tailwindcss.com', 
                'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap'
            ]);
        })
    );
    self.skipWaiting();
});

// 2. ACTIVATE: Bersihkan cache lama jika ada update
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// 3. FETCH: Strategi "Network First, Fallback to Cache"
self.addEventListener('fetch', (event) => {
    // Kita hanya peduli request navigasi (pindah halaman HTML)
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .catch(() => {
                    // JIKA INTERNET MATI (Error Fetch)
                    // Ambil halaman offline dari cache dan berikan ke user
                    return caches.match(OFFLINE_URL);
                })
        );
    }
});





// const CACHE_NAME = 'tokoku-v1';
// const OFFLINE_URL = '/offline.html';

// const STATIC_ASSETS = [
//   '/',
//   '/index.html',
//   '/offline.html',
//   '/manifest.json'
// ];

// // Install event - cache static assets
// self.addEventListener('install', (event) => {
//   event.waitUntil(
//     caches.open(CACHE_NAME).then((cache) => {
//       console.log('Opened cache');
//       return cache.addAll(STATIC_ASSETS);
//     })
//   );
//   self.skipWaiting();
// });

// // Activate event - clean old caches
// self.addEventListener('activate', (event) => {
//   event.waitUntil(
//     caches.keys().then((cacheNames) => {
//       return Promise.all(
//         cacheNames.map((cacheName) => {
//           if (cacheName !== CACHE_NAME) {
//             console.log('Deleting old cache:', cacheName);
//             return caches.delete(cacheName);
//           }
//         })
//       );
//     })
//   );
//   self.clients.claim();
// });

// // Fetch event - network first, fallback to cache
// self.addEventListener('fetch', (event) => {
//   if (event.request.mode === 'navigate') {
//     event.respondWith(
//       fetch(event.request)
//         .catch(() => {
//           return caches.open(CACHE_NAME).then((cache) => {
//             return cache.match(OFFLINE_URL);
//           });
//         })
//     );
//     return;
//   }

//   event.respondWith(
//     caches.match(event.request).then((response) => {
//       if (response) {
//         return response;
//       }

//       return fetch(event.request).then((response) => {
//         if (!response || response.status !== 200 || response.type !== 'basic') {
//           return response;
//         }

//         const responseToCache = response.clone();
//         caches.open(CACHE_NAME).then((cache) => {
//           cache.put(event.request, responseToCache);
//         });

//         return response;
//       });
//     })
//   );
// });