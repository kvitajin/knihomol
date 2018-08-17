'use strict';

let AKTUALNI_VERZE = "0.1.0";
let PRISTI_VERZE = "0.0.2";

this.addEventListener('install', function (event) {
	event.waitUntil(
		caches.open(AKTUALNI_VERZE).then(function (cache) {
			return cache.addAll([
				'/',
				'/index.php',
				'/js/appka.js',
				'/js/prvky.js',
				'/css/styl.css',
				'/manifest.json',
				'/vendor/vue.min.js',
				'/vendor/vue-material.js',
				'/vendor/vue-material.css',
				'/img/menu.svg',
				'/img/seznam.svg'
			]);
		})
	);
});

this.addEventListener('activate', function (event) {
	var cacheWhitelist = [PRISTI_VERZE];

	event.waitUntil(
		caches.keys().then(function (keyList) {
			return Promise.all(keyList.map(function (key) {
				if (cacheWhitelist.indexOf(key) === -1) {
					return caches.delete(key);
				}
			}));
		})
	);
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.open(AKTUALNI_VERZE).then(function(cache) {
      return cache.match(event.request).then(function(response) {
        var fetchPromise = fetch(event.request).then(function(networkResponse) {
          cache.put(event.request, networkResponse.clone());
          return networkResponse;
        })
        return response || fetchPromise;
      })
    })
  );
});