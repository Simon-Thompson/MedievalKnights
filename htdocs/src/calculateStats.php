<?php
//echo $_POST['energy'] . " " . $_POST['stat'];
	require_once "connection.php";

	$playerId = $_POST['playerId'];
	$reponse = $Cnn->prepare('SELECT attack, defence, speed, energy, will FROM user WHERE userId=:userId');
	$reponse->execute(array('userId' => $playerId));
	$playerStat = $reponse->fetch();
	$currentPlayerStat = 0;
	$stat = $_POST['stat'];
	$mult = round(((float) mt_rand(130000000,134000000))/10000000000, 10);
	switch ($stat) {
    case "attack":
		$boost = round($_POST['energy'] * $playerStat['will'] * $mult,0);
		$playerStat['attack'] = $playerStat['attack'] + $boost;
		$reponse = $Cnn->prepare('UPDATE user set attack = :attack WHERE userId=:userId');
		$reponse->execute(array('attack' => $playerStat['attack'], 'userId' => $playerId));
		$currentPlayerStat = $playerStat['attack'];
        break;
    case "defence":
		$boost = round($_POST['energy'] * $playerStat['will'] * $mult,0);
		$playerStat['defence'] = $playerStat['defence'] + $boost;
		$reponse = $Cnn->prepare('UPDATE user set defence = :defence WHERE userId=:userId');
		$reponse->execute(array('defence' => $playerStat['defence'], 'userId' => $playerId));
		$currentPlayerStat = $playerStat['defence'];
        break;
    case "speed":
		$boost = round($_POST['energy'] * $playerStat['will']* $mult,0);
		$playerStat['speed'] = $playerStat['speed'] + $boost;
		$reponse = $Cnn->prepare('UPDATE user set speed = :speed WHERE userId=:userId');
		$reponse->execute(array('speed' => $playerStat['speed'], 'userId' => $playerId));
		$currentPlayerStat = $playerStat['speed'];
        break;
	}
	
	echo json_encode(array(
        'boost' => $boost,
        'stat' => $stat,
		'currentStat' => $currentPlayerStat
        ));
?>