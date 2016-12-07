var public = 65537;

function isValid(str) { 
	return /^\w+$/.test(str); 
}

function check(u, p, ualert, palert) {
	var g2g = true;
	var user = document.getElementById(u).value;
	var pass = document.getElementById(p).value;
	var userAlert = document.getElementById(ualert);
	var passAlert = document.getElementById(palert);

	if (user.length < 3 || user.length > 16){
		userAlert.innerHTML = "Please input a username between 3 and 16 characters long";
		g2g = false;
	}
	else if (!isValid(user)){
		userAlert.innerHTML = "Please input a username with only letters, numbers, and underscores";
		g2g = false;
	}
	else { userAlert.innerHTML = ""; }

	if (pass.length < 8 || pass.length > 16){
		passAlert.innerHTML = "Please input a password between 8 and 16 characters long";
		g2g = false;
	}
	else if (!isValid(pass)){
		passAlert.innerHTML = "Please input a password with only letters, numbers, and underscores";
		g2g = false;
	}
	else { passAlert.innerHTML = ""; }

	return g2g;
}

function loginCheck() {
	var g2g = check("lu", "lp", "lualert", "lpalert");

	if(g2g) { 
		saveme();
		var pass = document.getElementById("lp").value;
		var num = document.getElementById("mol").value;
		var len = num.length;
		var enc = num.substr(1, len-2);
		document.getElementById("encl").value = encrypt(pass, public, enc);
		document.getElementById("lp").value = "";
		document.getElementById("loginForm").submit();
	}
}

function registrationCheck() {
	var g2g = check("ru", "rp", "rualert", "rpalert");

	if(g2g) {
		var pass = document.getElementById("rp").value;
		var confirm = document.getElementById("crp").value;
		var crpAlert = document.getElementById("crpalert");

		if (pass != confirm) {
			crpAlert.innerHTML = "Please confirm the password correctly";
			g2g = false;
		}
		else { crpAlert.innerHTML = ""; }
	}

	if(g2g) { 
		var pass = document.getElementById("rp").value;
		var num = document.getElementById("mod").value;
		var len = num.length;
		var enc = num.substr(1, len-2);
		document.getElementById("encr").value = encrypt(pass, public, enc);
		document.getElementById("rp").value = "";
		document.getElementById("crp").value = "";
		document.getElementById("regForm").submit(); 
	}
}

var usr;
var pw;
var sv;

function getCookieVal(offset) {
	var endstr = document.cookie.indexOf(";", offset);
	if (endstr == -1) { endstr = document.cookie.length; }
	return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie(name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
   	while (i < clen) {
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg) {
			return getCookieVal(j);
		}
		i = document.cookie.indexOf(" ", i) + 1;
        	if (i == 0) { break; }
	}
	return null;
}

function SetCookie(name, value, expires, path, domain, secure) {
	document.cookie = name + "=" + escape(value)
		+ ((expires) ? "; expires=" + expires.toGMTString() : "")
		+ ((path) ? "; path=" + path : "")
		+ ((domain) ? "; domain=" + domain : "")
		+ ((secure) ? "; secure" : "");
}

function DeleteCookie(name, path, domain) {
	if (GetCookie(name)) {
		document.cookie = name + "=" + ((path) ? "; path=" + path : "")
			+ ((domain) ? "; domain=" + domain : "")
			+ "; expires=Thu, 01-Jan-70 00:00:01 GMT";
	}
}

function getme() {
	usr = document.getElementById("lu");
	pw = document.getElementById("lp");
	sv = document.getElementById("rem");

	if (GetCookie('username') != null) {
		usr.value = GetCookie('username');
		pw.value = GetCookie('password');
	}
	if (GetCookie('save') == 'true') {
		sv.checked = true;
	}
}

function saveme() {
	var useCookie = document.getElementById("rem").checked;
	if (useCookie) {
		expdate = new Date();
		expdate.setTime(expdate.getTime() + 31536000000);
		SetCookie('username', document.getElementById("lu").value, expdate);
		SetCookie('password', document.getElementById("lp").value, expdate);
		SetCookie('save', 'true', expdate);
	}
	else {
		DeleteCookie('username');
        DeleteCookie('password');
        DeleteCookie('save');
	} 
}

function loadLog() {
	document.getElementById("loginForm").submit();
}

function loadReg() {
	document.getElementById("regForm").submit();
}
