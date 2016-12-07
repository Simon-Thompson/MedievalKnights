<?php
	require_once "connection.php";
	
	$playerId = $_POST['playerId'];
	$opponentId = $_POST['oppId'];
	
	$reponse = $Cnn->prepare('SELECT userId, userName, userLevel, userHealth, attack, defence, speed, power FROM user LEFT JOIN items on user.equipWeapon = items.itemId WHERE userId=:userId');
	$reponse->execute(array('userId' => $playerId));
	if(($playerStat = $reponse->fetch())== null)
		echo "user does not exist";
	
	$reponse = $Cnn->prepare('SELECT userId, userName, userLevel, userHealth, attack, defence, speed, power FROM user LEFT JOIN items on user.equipWeapon = items.itemId WHERE userId=:userId');
	$reponse->execute(array('userId' => $opponentId));
	if(($opponentStats = $reponse->fetch())== null)
		echo "user does not exist";
	
	
	$playerTurn = 0;
	
	while($playerTurn < 2){
		
		$crit = round(((float) mt_rand() / (float) mt_getrandmax()), 5);
		$damage = ($playerTurn == 0? (($playerStat['power'] == null? 5 : $playerStat['power']) + $crit) * $playerStat['attack']/$opponentStats['defence'] : (($opponentStats['power'] == null? 5 : $opponentStats['power']) + $crit) * $opponentStats['attack']/$playerStat['defence']);
		
		if($crit > 0.9)
			$damage = $damage * 1.5;
		
		$damage = round($damage,2);
		
		if($damage < 1)
			$damage = 1;
		
		$acc = round(($playerTurn == 0? $playerStat['speed']/$opponentStats['speed'] : $opponentStats['speed']/$playerStat['speed']), 2);
		
		if($acc > 2)
			$hitChance = 99;
		else if($acc > 1)
			$hitChance = mt_rand(80,99);
		else if($acc > 0.25)
			$hitChance = mt_rand(80,90);
		else if($acc > 0.1)
			$hitChance = mt_rand(40,79);
		else if($acc > 0.075)
			$hitChance = mt_rand(10,39);
		else
			$hitChance = mt_rand(1,9);
		
		if(mt_rand(1,100) > $hitChance)
			$damage = 0;
		
		if($playerTurn == 0)
			$opponentStats['userHealth'] -= $damage;
		else
			$playerStat['userHealth'] -= $damage;
		
		$battleDamage[$playerTurn] = $damage;
		
		if($opponentStats['userHealth'] <= 0){
			$opponentStats['userHealth'] = 0;
			$playerTurn++;
		}
		
		if($playerStat['userHealth'] < 0)
			$playerStat['userHealth'] = 0;
		
		$reponse = $Cnn->prepare('UPDATE user set userHealth = :health WHERE userId=:userId');
		$reponse->execute(array('health' => ($playerTurn == 0? $opponentStats['userHealth'] : $playerStat['userHealth']), 'userId' => ($playerTurn == 0? $opponentId : $playerId)));

		
		$playerTurn++;
	}
	
	if(isset($battleDamage)){
		$playerD = $playerStat['userName'] . " attacked " . $opponentStats['userName'];
		if($battleDamage[0] != 0)
			$playerD =  " doing $battleDamage[0] damage";
		else
			$playerD = " and missed";
		
		if($opponentStats["userHealth"] != 0){
			$oppD = $opponentStats['userName'] . " attacked " . $playerStat['userName'];
			if($battleDamage[1] != 0)
				$oppD = " doing $battleDamage[1] damage";
			else
				$oppD = " and missed";
		}
	}
	
	echo json_encode(array(
        'playerD' => $playerD,
        'oppD' => (isset($oppD)?$oppD : ''),
		'playerH' => $playerStat['userHealth'],
		'oppH' => $opponentStats['userHealth']
        ));
		
	
?>