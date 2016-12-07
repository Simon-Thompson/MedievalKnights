<?php
	$response = $Cnn->prepare('SELECT userPassword FROM user WHERE userName=:uName');
	$response->execute(array('uName' => $uName));
	$data = $response->fetch();

	if ($data == NULL) {
		echo '
			<p style="color:red">Username or Password is incorrect!</p>
			<a href="../src/login">Login Page</a><br>
			<a href="../src/registration">Registration Page</a>';
		session_unset();
		session_destroy();
	}

	elseif ($data[0] != $pswrd) {
		echo '
			<p style="color:red">Username or Password is incorrect!</p>
			<a href="../src/login">Login Page</a><br>
			<a href="../src/registration">Registration Page</a>';
		session_unset();
		session_destroy();
	}

	else {
		$response = $Cnn->prepare('UPDATE user SET modulus=:mod, privateKey=:private WHERE userName=:uName');
		$response->execute(array('mod' => $mod, 'private' => $private, 'uName' => $uName));
		$_SESSION['user'] = $uName;
		$_SESSION['modulus'] = $mod;

		$response = $Cnn->prepare('SELECT userId FROM user WHERE userName=:uName');
		$response->execute(array('uName' => $uName));
		$data = $response->fetch();
		$_SESSION['ID'] = $data[0];
		header("Location: ../main.php");
	}
?>