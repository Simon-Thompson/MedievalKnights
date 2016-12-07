var size = 30;
var public = 65537;

function getRandom(max) {
	var num = Math.ceil(Math.random() * 9);
	var k = num.toString();
	var result = k;

	for (var i = 0; i < max-1; i++){
		num = Math.floor(Math.random() * 10);
		k = num.toString();
		result = result + k;
	}

	num = Math.floor(Math.random() * 5) * 2 + 1;
	k = num.toString();
	result = result + k;

	return result;
}

function gcd(x, y){
	while (!bigInt(y).equals(0)) {
        var z = bigInt(x).mod(bigInt(y));
		x = bigInt(y);
		y = bigInt(z);
	}
	return bigInt(x).toString();
}

function xgcd(a,b) { 
	if (bigInt(b).equals(0)) { return [1, 0, a]; }
	else {
	    var temp = xgcd(b, bigInt(a).mod(bigInt(b)));
	    var x = temp[0];
	    var y = temp[1];
	    var d = temp[2];
	    var div = bigInt(a).divide(bigInt(b));
	    var mul = bigInt(y).multiply(bigInt(div));
	    var sub = bigInt(x).minus(bigInt(mul));
	    return [y, sub, d];
	}
}

function primeTest(inputNum){
    var numTrials = 50;
    
    for (var trial = 0; trial < numTrials; trial++){

  		var numLength = Math.floor(Math.random() * (size-6)) + 6;
        var randTest = getRandom(numLength);

        if (!bigInt(gcd(randTest,inputNum)).equals(1)){
	        return false;
        }		     		        
    }
    
    return true;
}

function getLargePrime() {
	var p = getRandom(size);

	while (!primeTest(p)) {
		p = getRandom(size);
	}
	return p;
}

function rsa() {
	var p = getLargePrime();
	var q = getLargePrime();
	var n = bigInt(p).multiply(bigInt(q)).toString();

	var pm1 = bigInt(p).minus(1).toString();
	var qm1 = bigInt(q).minus(1).toString();
	var totient = bigInt(pm1).multiply(bigInt(qm1)).toString();

	var d = xgcd(public, totient)[0].toString();

	if(bigInt(d).lesser(0)) {
		d = bigInt(totient).add(bigInt(d)).toString();
	}

	return [d, n];
}

function encrypt(message, key, modo) {
	var result = "";
	for (var i = 0; i < message.length; i++) {
		var m = message.charCodeAt(i).toString();
		var c = bigInt(m).modPow(bigInt(key), bigInt(modo)).toString();

		if (i == message.length - 1) {
			result = result + c;
		}
		else {
			result = result + c + "#";
		}
	}
	return result;
}

function decrypt(encMessage, key, modo) {
	var result = "";
	var numArray = encMessage.split("#");
	for (var i = 0; i < numArray.length; i++) {
		var c = numArray[i];
		var m = bigInt(c).modPow(bigInt(key), bigInt(modo)).toString();
		result = result + String.fromCharCode(m);
	}
	return result;
}

function sample() {
	var keys = rsa();
	var private = keys[0];
	var modo = keys[1];

	var encrypted = encrypt("whatup", public, modo);
	var decrypted = decrypt(encrypted, private, modo);

	while (decrypted != "whatup") {
		keys = rsa();
		private = keys[0];
		modo = keys[1];

		encrypted = encrypt("whatup", public, modo);
		decrypted = decrypt(encrypted, private, modo);
	}

	return [private, modo];
}