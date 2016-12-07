#!/Python27/python

import cgi
import time
import os
import datetime
import httplib

public = 65537

form = cgi.FieldStorage()
mod = form.getvalue('mol')[2:len(form.getvalue('mol'))-2]
encPass = form.getvalue('encl')
uName = form.getvalue('userid')

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

name = "keyLogs/keyLog_" + time.strftime("%d_%m_%Y") + ".log"
fo = open(name, "r")

data = fo.read()
modList = data.split("$")
private = ''

for i in range(0, len(modList)):
	curr = modList[i].split('#')
	if mod == curr[0]:
		private = curr[1]
		break

fo.close()

if private == '' :
	yesterday = datetime.date.today() - datetime.timedelta(1)
	name = "keyLogs/keyLog_" + yesterday.strftime("%d_%m_%Y") + ".log"

	fo = open(name, "r")

	data = fo.read()
	modList = data.split("$")
	private = ''

	for i in range(0, len(modList)):
		curr = modList[i].split('#')
		if mod == curr[0]:
			private = curr[1]
			break

	fo.close()

pswrd = decrypt(encPass, int(private), int(mod))

httpServ = httplib.HTTPConnection("127.0.0.1", 80)
httpServ.connect()

httpServ.request('GET', 'http://localhost/src/log.php?uid=%s&pw=%s&mod=%s&priv=%s' % (uName, pswrd, mod, private))

response = httpServ.getresponse()

print ("Content-type: text/html\n\n")
print ('''
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>Registration</title>
			<script type="text/javascript" src="../js/login.js"> </script>
			<script type="text/javascript" src="../js/rsaEncryption.js"> </script>
			<script type="text/javascript" src="../js/BigInteger.js"> </script>
		</head>

		<body>''')

print (response.read())

print ('''
		</body>
	</html>''')

httpServ.close()
