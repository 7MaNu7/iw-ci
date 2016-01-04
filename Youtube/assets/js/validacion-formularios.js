var email = document.getElementById("email");
email.val;

email.onblur = function() {
	if(email.value == "") {
		email.style.borderColor = "rgba(255, 0, 0, 0.51)";
		email.appendChild('<h1>hola</h1>')
	}
}