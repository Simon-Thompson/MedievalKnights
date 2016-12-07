<?php
	require_once "connection.php";
	try{
		$mailId = $_POST['mailId'];
		$playerId = $_POST['playerId'];
		$response = $Cnn->prepare('DELETE FROM mails WHERE mailId = :mailId');
		$response->execute(array('mailId' => $mailId));
		
		require_once "generateInbox.php";
	}
	catch (PDOException $erreur)
	{        
		echo 'Erreur : '.$erreur->getMessage();
	}
?>