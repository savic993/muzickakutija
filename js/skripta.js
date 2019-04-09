function napraviKanal()
{
	var k = null;
	if (window.XMLHttpRequest) {
		k = new XMLHttpRequest();
	}
	else{
		k = new ActiveXObject("Microsoft.XMLHTTP");
	}
	if (k!=null) {
		return k;
	}
}
function logovanje()
{
	var greske = new Array();
	var username = document.getElementById('tbUsername').value;
	var lozinka = document.getElementById('tbLozinka').value;

	var regUsername = /^(\w)+(\d)*$/;
	var regLozinka = /^[A-Za-z0-9]{6,10}$/;

	if (!regUsername.test(username)) {
		greske.push("Username nije u dobrom formatu.");
		document.getElementById('tbUsername').style.border = '1px solid #ff0000';
	}
	if (!regLozinka.test(lozinka)) {
		greske.push("Password nije u dobrom formatu.");
		document.getElementById('tbLozinka').style.border = '1px solid #ff0000';
	}

	if (greske.length == 0) {
		return true;
	}
	else
	{
		return false;
	}
}
function registracija()
{
	var greske = new Array();
	var username = document.getElementById('tbUsername').value;
	var imePrezime = document.getElementById('tbImePrezime').value;
	var email = document.getElementById('tbEmail').value;
	var lozinka = document.getElementById('tbPassword').value;
	var ponovoLozinka = document.getElementById('tbPasswordAgain').value;

	var regUsername = /^[A-z]{2,20}([0-9])*$/;
	var regImePrezime = /^[A-Z][a-z]{2,10}\s[A-Z][a-z]{4,10}$/;
	var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (!regUsername.test(username)) {
		greske.push("Username nije u dobrom formatu.");
		document.getElementById('tbUsername').style.border = '1px solid #ff0000';
	}
	if (!regImePrezime.test(imePrezime)) {
		greske.push("Password nije u dobrom formatu.");
		document.getElementById('tbLozinka').style.border = '1px solid #ff0000';
	}
	if (!regEmail.test(email)) {
		greske.push("Password nije u dobrom formatu.");
		document.getElementById('tbLozinka').style.border = '1px solid #ff0000';
	}

	if (greske.length == 0) {
		return true;
	}
	else
	{
		return false;
	}
}