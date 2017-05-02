'use strict';

function generujMezi() {
	let min = document.getElementById("min").value;
	let max = document.getElementById("max").value;

	if (min > max) {
		document.getElementById("cisla_d").innerHTML = "NaN";
	} else {
		let vygenerovane_cislo = Math.floor(Math.random() * (max - min + 1)) + (min * 1);
		document.getElementById("cisla_d").innerHTML = vygenerovane_cislo;
	}
}

function registrujWorkera() {
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('/genace/worker.js', { scope: '/genace/' })
			.then(function (reg) {
				// registration worked
				console.log("Registration succeeded. Scope is " + reg.scope);
				reg.update();
				
			}).catch(function (error) {
				// registration failed
				console.log("Registration failed with " + error);
			});
	}
}
registrujWorkera();