<?php
	session_id("kvt835e5th613t0i29ur1stdv7");
	if(!isset($_SESSION))
		session_start();


	$uid = $_SESSION['user'];

	require_once "connection.php";

	$response = $Cnn->prepare('UPDATE user SET modulus=:mod, privateKey=:priv WHERE userName=:uid');	
	$response->execute(array('mod' => '', 'priv' => '', 'uid' => $uid));	
	session_unset();
	session_destroy();


echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>Login</title>
				<script type="text/javascript" src="../js/login.js"> </script>
			</head>

			<body onload="loadLog()">
				<br><br>
				<b><i><p>Please be patient while the server generates encryption keys for the security of your passwords</p></i></b>
			  	<form name="login" id="loginForm" action="../../cgi-bin/logCheck.py">
				</form>
			</body>
		</html>';
?>