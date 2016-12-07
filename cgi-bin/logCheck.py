#!/Python27/python

import random
import time
import os

size = 1000000000000000000000000000000
public = 65537

def getNum():
	num = random.randrange(size, size*10)
	return num

def gcd(x, y):
	while y != 0:
	  	z = x % y
		x = y
		y = z

	return x

def xgcd(a,b):
	if b == 0:
		return [1, 0, a]
	else :
	    temp = xgcd(b, a % b)
	    x = temp[0]
	    y = temp[1]
	    d = temp[2]
	    return [y, x - (y*(a/b)), d]

def getLargePrime():
	num = getNum()

	while primeTest(num) == False:
		num = getNum()

	return num

def primeTest(inputNum):
    numTrials = 50
    
    for trial in range(0, numTrials):
        randTest = getNum()

        if gcd(inputNum, randTest) != 1:
       		return False

	return True

def rsa():
	p = getLargePrime()
	q = getLargePrime()
	n = p * q

	totient = (p-1) * (q-1)
	d = xgcd(public, totient)[0]

	if d < 0 :
		d = totient + d

	return [d, n]

def encrypt(message, key, modo):
	result = ""
	for i in range(0, len(message)):
		m = ord(message[i])
		c = str(pow(m, key, modo))

		if i == (len(message) - 1) :
			result = result + c

		else :
			result = result + c + "#"

	return result

def decrypt(encMessage, key, modo):
	result = ""
	numArray = encMessage.split("#")
	for i in range(0, len(numArray)):
		c = int(numArray[i])
		m = pow(c, key, modo)

		if m > 126:
			result = result + chr(97)

		else :
			result = result + chr(m)

	return result

def sample():
	keys = rsa()
	private = keys[0]
	modo = keys[1]

	encrypted = encrypt("whatup", public, modo);
	decrypted = decrypt(encrypted, private, modo);

	while decrypted != "whatup" :
		keys = rsa()
		private = keys[0]
		modo = keys[1]

		encrypted = encrypt("whatup", public, modo)
		decrypted = decrypt(encrypted, private, modo)

	return [private, modo]

keys = sample()
private = keys[0]
modo = keys[1]

name = "keyLogs/keyLog_" + time.strftime("%d_%m_%Y") + ".log"

fo = open(name, "a+")
os.chmod(name, 0777)
fo.write(str(modo))
fo.write("#")
fo.write(str(private))
fo.write("$")
fo.close()

print ("Content-type: text/html\n\n")
print ('''
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/login.js"> </script>
		<script type="text/javascript" src="../js/rsaEncryption.js"> </script>
		<script type="text/javascript" src="../js/BigInteger.js"> </script>
	</head>

	<body onload="getme()" style="background-color: #ffffcc;">
	<h1 style="text-align:center;font-family: blackchancery, Arial, Helvetica, Sans-Serif;font-size: 50px;">Medieval Knights</h1>
		<a href="../src/registration">Registration Page</a>
		<p>If you are already a user, please login in here:<br/></p>

	  	<form method="post" name="login" id="loginForm" action="../src/logquery.php">
	    	<input type="text" class="form-control" placeholder="Username" name="userid" id="lu">
			<div style="color:red" id="lualert"></div><br/>
	 		<input type="password" class="form-control" placeholder="Password" name="pswrd" id="lp">
			<div style="color:red" id="lpalert"></div><br/>
			<button class="btn-warning" type="reset">Cancel</button>
	    	<button class="btn-primary" type="button" onclick="loginCheck()">Login</button><br/>
			<input type="checkbox" name="rem" id="rem">Remember me
			<input type="hidden" name="encl" id="encl" value="">
			<input type="hidden" name="mol" id="mol" value="''')

print (str(modo))

print ('''">
		</form>
	</body>
</html>''')

