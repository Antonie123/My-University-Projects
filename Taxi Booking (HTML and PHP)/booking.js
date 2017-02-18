// Created by Antonie Chau
// AUT ID: 1305095
//This is the javascript that handles the booking process.

//Checks that all the submitted values in the fields are valid before the are pushed into the database.
function checkBooking(firstName, lastName, custNumber, aptUnit, aptNumber, streetName, suburb, destSuburb, pickupDate, pickupTime) {
	var notice = "Please fill the following field: ";
	//First name validation
	if (firstName.length <= 0 ) {
		var missingfirstName = "First name";
		notice = notice.concat(missingfirstName);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!firstName.match(/^[a-zA-Z]+$/)) {
		divMessage.innerHTML = "Only alphabets are valid for first name.";
		return false;
	}
	//Last name validation
	if (lastName.length <= 0) {
		var missinglastName = "Last name";
		divMessage = document.getElementById("divMessage");
		notice = notice.concat(missinglastName);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!lastName.match(/^[a-zA-Z]+$/)) {
		divMessage.innerHTML = "Only alphabets are valid for last name.";
		return false;
	}
	//Phone number validation
	if (custNumber.length <= 0) {
		var missingcustNumber = "Contact Number";
		notice = notice.concat(missingcustNumber);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!custNumber.match(/^[0-9]{7,7}$/)) {
		divMessage.innerHTML = "Phone number requires 7 Digits.";
		return false;
	}
	//Unit letter validation
	if (!aptUnit.match(/^[A-Fa-f]$/) && aptUnit.length != 0) {
		divMessage.innerHTML = "Unit can only contain 1 alphabet from A-F.";
		return false;
	}
	//Unit number validation
	if (aptNumber.length <= 0) {
		var missingaptNumber = "Street Number";
		notice = notice.concat(missingaptNumber);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!aptNumber.match(/^[0-9]{1,4}$/)) {
		divMessage.innerHTML = "Street number can only contain numbers 0-9 and up to 4 digits";
		return false;
	}
	//Steet name validation
	if (streetName.length <= 0) {
		var missingstreetName = "Street Name";
		notice = notice.concat(missingstreetName);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!streetName.match(/^[A-Za-z ]{1,30}$/)) {
		divMessage.innerHTML = "Street name can only contain alphabets.";
		return false;
	}
	//Suburb name validation
	if (suburb.length <= 0) {
		var missingSuburb = "Suburb";
		notice = notice.concat(missingSuburb);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!suburb.match(/^[A-Za-z]{1,20}$/)) {
		divMessage.innerHTML = "Suburb can only contain alphabets.";
		return false;
	}
	if (destSuburb.length <= 0) {
		var missingDestSuburb = "Destination suburb";
		notice = notice.concat(missingDestSuburb);
		divMessage.innerHTML = notice;
		return false;
	}
	if (!destSuburb.match(/^[A-Za-z]{1,20}$/)) {
		divMessage.innerHTML = "The destination suburb can only contain letters from the english alphabet.";
		return false;
	}
	//Pick up date validation
	if (pickupDate.length <= 0) {
		var missingPickUpDate = "Pick-up Date";
		notice = notice.concat(missingPickUpDate);
		divMessage.innerHTML = notice;
		return false;
	}
	//Code to check that the booked date does not precede the current date
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	if(dd<10) {
		dd='0'+dd
	} 
	if(mm<10) {
		mm='0'+mm
	} 
	today = yyyy+'-'+mm+'-'+dd;
	if (pickupDate <= today) {
		divMessage.innerHTML = "Date invalid, please select a later date.";
		return false;
	}
	if (pickupTime.length <= 0) {
		var missingpuTime = "Pick-up Time";
		notice = notice.concat(missingpuTime);
		divMessage.innerHTML = notice;
		return false;
	}
	divMessage.innerHTML = "Booking Processing";
	processBooking(firstName, lastName, custNumber, aptUnit, aptNumber, streetName, suburb, destSuburb, pickupDate, pickupTime);
}

//Handles all the processing of the booking
function processBooking(firstName, lastName, custNumber, aptUnit, aptNumber, streetName, suburb, destSuburb, pickupDate, pickupTime) {
	var xmlhttp = null; 

	if (window.XMLHttpRequest) { 
		xmlhttp = new XMLHttpRequest(); 
	} else if (window.ActiveXObject) { 
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
	} 
	var data ="name="+encodeURIComponent(firstName + " " + lastName)
	+"&phone="+encodeURIComponent(custNumber)
	+"&streetAdd="+encodeURIComponent(aptNumber+aptUnit+" "+streetName+", "+suburb)
	+"&destSuburb="+encodeURIComponent(destSuburb)
	+"&puDateTime="+encodeURIComponent(pickupDate + " " + pickupTime)
	+"&puDate="+encodeURIComponent(pickupDate)
	+"&puTime="+encodeURIComponent(pickupTime);	
	xmlhttp.open("POST", "bookingprocess.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState==4 && xmlhttp.status == 200) {
			divMessage.innerHTML = xmlhttp.responseText;
		}
	};
}