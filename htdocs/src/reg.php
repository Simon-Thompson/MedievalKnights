<?php
	$response = $Cnn->prepare('SELECT userId FROM user WHERE userName=:uName');
	$response->execute(array('uName' => $uName));
	$data = $response->fetch();

	if ($data == NULL) {
		$response = $Cnn->prepare('INSERT INTO user (userName, userPassword, privateKey, modulus) VALUES (:uName, :pswrd, :private, :mod)');
		$response->execute(array('uName' => $uName, 'pswrd' => $pswrd, 'private' => $private, 'mod' => $mod));
		$_SESSION['user'] = $uName;
		$_SESSION['modulus'] = $mod;

		$response = $Cnn->prepare('SELECT userId FROM user WHERE userName=:uName');
		$response->execute(array('uName' => $uName));
		$data = $response->fetch();
		$_SESSION['ID'] = $data[0];
		header("Location: ../main.php");
	}

	else {
		echo '
			<p style="color:red">Username is taken!</p>
			<a href="../src/login">Login Page</a><br>
			<a href="../src/registration">Registration Page</a>';
		session_unset();
		session_destroy();
	}
?>