<?php
	if(!isset($_SESSION))
		session_start();

	require_once "connection.php";

	$public = 65537;

	$mod = substr($_POST['mol'], 2, strlen($_POST['mol'])-4);
	$encPass = $_POST['encl'];
	$uName = $_POST['userid'];

	$name = "../../cgi-bin/keyLogs/keyLog_" . date("d_m_Y") . ".log";

	if (file_exists($name)) {
		$fo = fopen($name, "r+");

		$data = fread($fo, filesize($name));
		$modList = explode("$", $data);
		$private = '';

		for ($i = 0; $i < sizeof($modList); $i++) {
			$curr = explode("#", $modList[$i]);
			if ($mod == $curr[0]) {
				$private = $curr[1];
				break;
			}
		}
		fclose($fo);
	}

	else {
		$yesterday = date("d_m_Y", time() - 60 * 60 * 24);
		$name = "../../cgi-bin/keyLogs/keyLog_" . $yesterday . ".log";

		$fo = fopen($name, "r+");

		$data = fread($fo, filesize($name));
		$modList = explode("$", $data);
		$private = '';

		for ($i = 0; $i < sizeof($modList); $i++) {
			$curr = explode("#", $modList[$i]);
			if ($mod == $curr[0]) {
				$private = $curr[1];
				break;
			}
		}

		fclose($fo);
	}

	$pswrd = "";
	$numArray = explode("#", $encPass);
	for ($i = 0; $i < sizeof($numArray); $i++){
		$c = $numArray[$i];
		$m = (int)bcpowmod($c, $private, $mod);

		if ($m > 126){
			$pswrd = $pswrd . chr(97);
		}

		else {
			$pswrd = $pswrd . chr($m);
		}
	}

	require_once("log.php");

?>