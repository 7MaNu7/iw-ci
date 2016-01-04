/* LOGIN */
var email = document.getElementById("email");
email.val;

email.onblur = function() {
	if(email.value == "") {
		email.style.borderColor = "rgba(255, 0, 0, 0.51)";
	} else {
		email.style.borderColor = "#ccc";
	}
}

var password = document.getElementById("password");
password.val;

password.onblur = function() {
	if(password.value == "") {
		password.style.borderColor = "rgba(255, 0, 0, 0.51)";
	} else {
		password.style.borderColor = "#ccc";
	}
}