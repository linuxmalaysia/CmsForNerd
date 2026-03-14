const CACHE_NAME = 'cmsfornerd-pwa-v1';
const ASSETS_TO_CACHE = [
    '/offline.php',
    '/manifest.json',
    '/themes/CmsForNerd/style.css',
    '/assets/pwa/icon-192x192.png',
    '/assets/pwa/icon-512x512.png'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[Service Worker] Pre-caching offline assets');
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
    // Force the waiting service worker to become the active service worker
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log('[Service Worker] Removing old cache', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    // Claim control immediately for the current page
    self.clients.claim();
});

self.addEventListener('fetch', (event) => {
    // Only intercept basic navigation requests (HTML pages)
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request)
                .then((networkResponse) => {
                    // Cache the successful network response for future offline use (Stale-While-Revalidate pattern option)
                    // For now, we just pass it through on success to keep logic simple.
                    return networkResponse;
                })
                .catch(() => {
                    console.log('[Service Worker] Network failed, serving offline fallback');
                    return caches.match('/offline.php');
                })
        );
    } else {
        // For standard assets (CSS, Images), serve Cache First, then Network
        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                return cachedResponse || fetch(event.request);
            })
        );
    }
});
