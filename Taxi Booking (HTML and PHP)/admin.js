// Created by Antonie Chau
// AUT ID: 1305095
//Javascript to handle the admin tasks of viewing requests and assigning taxis.

//Code for pulling all requests that are unassigned
function showRequests() {
	var xhr = new XMLHttpRequest();
	var message = document.getElementById("divMessage");
	xhr.open("POST", "showRequests.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send();
	xhr.onreadystatechange = function() {
		if (xhr.readyState==4 && xhr.status == 200) {
			message.innerHTML = xhr.responseText;
		}
	};
}

//Checks that a booking number was input and isn't alphabetical before calling the assignTaxi function.
function checkBookingNumber(bookingID) {	
	if (bookingID <= 0) {
		divMessage.innerHTML = "No booking number was entered.";
		return false;
	}
	if (!bookingID.match(/^[0-9]{1,4}$/)){
		divMessage.innerHTML = "Only numbers for booking numbers!";
		return false;
	}
	assignTaxi(bookingID);
}

function assignTaxi(bookingNumber) {
	var xmlhttp = null; 
	if (window.XMLHttpRequest) { 
		xmlhttp = new XMLHttpRequest(); 
	} else if (window.ActiveXObject) { 
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
	} 	
	var data ="bookID="+encodeURIComponent(bookingNumber);	
	xmlhttp.open("POST", "assignRequests.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState==4 && xmlhttp.status == 200) {
			divMessage.innerHTML = xmlhttp.responseText;
		}
	};
}