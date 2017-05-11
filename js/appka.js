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

			}).catch(function (error) {
				// registration failed
				console.log("Registration failed with " + error);
			});
	}
}

function nastavMaterial() {
	Vue.use(VueMaterial);

	Vue.material.registerTheme('default', {
		primary: 'teal',
		accent: 'red',
		warn: 'red',
		background: {
			color: 'blue-grey',
			hue: 50
		}
	});

	var App = new Vue({
		el: '#genace',
		methods: {
			toggleLeftSidenav() {
				this.$refs.leftSidenav.toggle();
			},
			open(ref) {
				console.log('Opened: ' + ref);
			},
			close(ref) {
				console.log('Closed: ' + ref);
			}
		},
		data: {
			pocatecniHodnotaMin: 0,
			pocatecniHodnotaMax: 9
		}
	});

}

nastavMaterial();
registrujWorkera();