'use strict';

this.addEventListener('install', function (event) {
	event.waitUntil(
		caches.open('v1').then(function (cache) {
			return cache.addAll([
				'/genace/',
				'/genace/index.html',
				'/genace/js/appka.js',
				'/genace/js/prvky.js',
				'/genace/css/styl.css',
				'/genace/manifest.json'
			]);
		})
	);
});

this.addEventListener('activate', function (event) {
	var cacheWhitelist = ['v2'];

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

this.addEventListener('fetch', function (event) {
	event.respondWith(
		caches.match(event.request).then(function (resp) {
			return resp || fetch(event.request).then(function (response) {
				return caches.open('v1').then(function (cache) {
					cache.put(event.request, response.clone());
					return response;
				});
			});
		})
	);
});