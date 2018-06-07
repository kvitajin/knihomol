'use strict';

function generujMezi(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + (min * 1);
}

function generatorCiselVypocet() {
	let min = Number(document.getElementById("min").value);
	let max = Number(document.getElementById("max").value);

	if (min > max) {
		document.getElementById("cisla_d").innerHTML = "NaN";
	} else {
		let vygenerovane_cislo = generujMezi(min, max);
		document.getElementById("cisla_d").innerHTML = vygenerovane_cislo;
	}
}

function generatorSmeruVypocet(pocet_smeru) {
	let vygenerovane_cislo = generujMezi(0, pocet_smeru - 1);

	if (vygenerovane_cislo == 0) {
		document.getElementById("cesty_d").src = "img/sipka_LEFT.svg";
	} else if (vygenerovane_cislo == 1) {
		document.getElementById("cesty_d").src = "img/sipka_RIGHT.svg";
	} else if (vygenerovane_cislo == 2) {
		document.getElementById("cesty_d").src = "img/sipka_UP.svg";
	} else if (vygenerovane_cislo == 3) {
		document.getElementById("cesty_d").src = "img/sipka_DOWN.svg";
	}
}

function registrujWorkera() {
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('/genace/worker.js', { scope: '/genace/' })
			.then(function (reg) {
				// registration worked
				console.log("Registration succeeded. Scope is " + reg.scope);

			}).catch(function (error) {
				// registration failed
				console.log("Registration failed with " + error);
			});
	}
}

function nastavMaterial() {
	Vue.use(VueMaterial.default);

	window.appka = new Vue({
		el: '#genace',
		data: {
			typ_generatoru: 0,
			pocatecniHodnotaMin: 0,
			pocatecniHodnotaMax: 9,
			showNavigation: false
		},
		methods: {
			generatorCiselVypocet: generatorCiselVypocet,
			generatorSmeruVypocet: generatorSmeruVypocet
		}
	});

}

nastavMaterial();
registrujWorkera();