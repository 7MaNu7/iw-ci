/* LOGIN */

var title = document.getElementById("title");

title.onblur = function() {
	if(title.value == "") {
		title.style.borderColor = "rgba(255, 0, 0, 0.51)";
	} else {
		title.style.borderColor = "#ccc";
	}
}

var url = document.getElementById("url");

url.onblur = function() {
	if(url.value == "") {
		url.style.borderColor = "rgba(255, 0, 0, 0.51)";
	} else {
		url.style.borderColor = "#ccc";
	}
}
