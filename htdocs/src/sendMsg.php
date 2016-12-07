<?php
//echo $_POST['energy'] . " " . $_POST['stat'];
	require_once "connection.php";
try{
	$playerId = $_POST['playerId'];
	$targetUser = $_POST['uname'];
	$msg = $_POST['msg'];
	date_default_timezone_set("America/Toronto");
	$mailDate = date('Y-m-d H:i:s');

	$response = $Cnn->prepare('SELECT userId FROM user WHERE userName=:targetUser');
	$response->execute(array('targetUser' => $targetUser));
	$data = $response->fetch();

	if ($data == NULL) {
		$returnmsg = 'User does not exist!';
		echo json_encode(array(
        'returnmsg' => $returnmsg
        ));
	}

	else {
		$targetId = $data[0];
		$response = $Cnn->prepare('INSERT INTO mails (mailSenderId, mailReceiverId, mailMessage, mailDate) VALUES (:playerId, :targetId, :msg, :mailDate)');
		$response->execute(array('playerId' => $playerId, 'targetId' => $targetId, 'msg' => $msg, 'mailDate' => $mailDate));

		$returnmsg = 'Message Sent!';
		echo json_encode(array(
        'returnmsg' => $returnmsg
        ));
	}
}
catch (PDOException $erreur)
{        
	echo 'Erreur : '.$erreur->getMessage();
}
?>