$(document).ready(function() {
	
	console.log("Im ready!");

	var req = new XMLHttpRequest();
	var path="http://api.art.rmngp.fr";

	req.open("GET", path, true); 
	req.setRequestHeader("Apikey", "690d41b6f7545618209b43331f39e5fb06faaa1f989249d9b86983f679a2b3bd");
	req.onreadystatechange = monCode;   // la fonction de prise en charge
	req.send(null);

	function monCode() { 
	        alert('je suis pret');
	}

});