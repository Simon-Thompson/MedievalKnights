<?php
	require_once "connection.php";
	
	$playerId = $_POST['playerId'];
	$opponentId = $_POST['oppId'];
	
	
	$reponse = $Cnn->prepare('SELECT userLevel, userHealth FROM user WHERE userId=:userId');
	$reponse->execute(array('userId' => $playerId));
	$playerStat = $reponse->fetch();
	
	
	$reponse = $Cnn->prepare('SELECT userLevel FROM user WHERE userId=:userId');
	$reponse->execute(array('userId' => $opponentId));
	$opponentStats = $reponse->fetch();
	
	if($playerStat['userHealth'] == 0 && $playerStat['userLevel'] != 1){
		$playerStat['userLevel'] = $playerStat['userLevel'] - 1;
	}
	else if($playerStat['userHealth'] != 0 && $opponentStats['userLevel']+10 > $playerStat['userLevel']){
		$playerStat['userLevel'] = $playerStat['userLevel'] + 1;
	}
	
	$reponse = $Cnn->prepare('UPDATE user set userLevel = :userLevel WHERE userId=:userId');
	$reponse->execute(array('userLevel' => $playerStat['userLevel'], 'userId' => $playerId));
	
	$playerTurn = 0;
	while($playerTurn < 2){
		$reponse = $Cnn->prepare('UPDATE user set userHealth = :health WHERE userId=:userId');
		$reponse->execute(array('health' => ($playerTurn == 0? (150 + 50 * $opponentStats['userLevel']) : (150 + 50 * $playerStat['userLevel'])), 'userId' => ($playerTurn == 0? $opponentId : $playerId)));
		$playerTurn++;
	}
	
?>