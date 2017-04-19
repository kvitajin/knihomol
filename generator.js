function generujMezi() {
	let min = document.getElementById("min").value;
	let max = document.getElementById("max").value;
	
	if (min > max) {
		document.getElementById("displej").innerHTML = "NaN";
	} else {
		let vygenerovane_cislo = Math.floor(Math.random() * (max - min + 1)) + (min * 1);
		document.getElementById("displej").innerHTML = vygenerovane_cislo;
	}
}
