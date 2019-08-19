//CARA ENCODE JAVASCRIPT
/*let mahasiswa = {
	nama : "Firnan Sholihuda",
	nim : "123140088",
	email : "sholihuda@gmail.com"
}

console.log(JSON.stringify(mahasiswa));*/ //untuk encode nya

//CARA DECODE JAVASCRIPT
/*let xhr = new XMLHttpRequest();
xhr.onreadystatechange = function () {
	if (xhr.readyState == 4 && xhr.status == 200) {
		let mahasiswa = JSON.parse(this.responseText); //untuk decode nya
		console.log(mahasiswa);
	}
}

xhr.open('GET', 'coba.json', true);
xhr.send();*/

//CARA JQUERY
$.getJSON('coba.json', function(data) {
	console.log(data);
	});