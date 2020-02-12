function bad() {
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
  	context.fillStyle = "red";
  	context.fillRect(5,5,100,10);
}
function medium() {
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	context.fillStyle = "red";
	context.fillRect(5,5,100,10);
	context.fillStyle = "orange";
	context.fillRect(100,5,100,10);
}
function good() {
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');

	context.fillStyle = "red";
	context.fillRect(5,5,100,10);
	context.fillStyle = "orange";
	context.fillRect(100,5,100,10);
	 context.fillStyle = "green";
	 context.fillRect(200,5,100,10);
}

function verif_mdp() {
	const mdp = document.getElementById('mdp').value.length;
	if (mdp+1 <4) {

	bad();
}
	if (mdp+1 >= 4 && mdp+1 <=8) {
		medium();
	}
	if (mdp+1 > 8 ) {
		good();
	}

}
