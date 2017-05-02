'use strict';

function nactiGNC() {
	let gnc = document.createElement('div');
	gnc.id = "generator";

	let displej = document.createElement('div');
	displej.class = "displej";
	displej.id = "cesty_d";
	
	let batn_dva_smery = document.createElement('input');
	batn_dva_smery.type = "submit";
	batn_dva_smery.value = "2 směry";

	let batn_tri_smery = document.createElement('input');
	batn_tri_smery.type = "submit";
	batn_tri_smery.value = "3 směry";

	gnc.appendChild(displej);
	gnc.appendChild(batn_dva_smery);
	gnc.appendChild(batn_tri_smery);

	let stavajici_generator = document.getElementById("generator");
	stavajici_generator.replaceWith(gnc);
}