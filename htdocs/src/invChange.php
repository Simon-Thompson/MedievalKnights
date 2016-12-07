<?php
//echo $_POST['energy'] . " " . $_POST['stat'];
	require_once "connection.php";
try{
	$playerId = $_POST['userId'];
	$itemId = $_POST['itemId'];
	$func = $_POST['func'];

	$response = $Cnn->prepare('SELECT itemName FROM items WHERE itemId=:itemId');
	$response->execute(array('itemId' => $itemId));
	$data = $response->fetch();

	$iName = $data[0];

	if ($func == 1) {
		$response = $Cnn->prepare('UPDATE user SET equipWeapon=:itemId WHERE userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		echo json_encode(array('itemName' => $iName, 'itemId' => $itemId));
	}

	else if ($func == 2) {
		$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:itemId AND userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		$data = $response->fetch();

		if ($data[0] == 1) {
			$response = $Cnn->prepare('DELETE FROM inventory WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));

			$response = $Cnn->prepare('UPDATE user SET equipWeapon=:itemId WHERE userId=:playerId');
			$response->execute(array('itemId' => NULL, 'playerId' => $playerId));

			$returnmsg = 0;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}

		else {
			$response = $Cnn->prepare('UPDATE inventory SET quantity=:newQuantity WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('newQuantity' => ($data[0] - 1),'itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = $data[0] - 1;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}
	}

	else if ($func == 5) {
		$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:itemId AND userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		$data = $response->fetch();

		if ($data[0] == 1) {
			$response = $Cnn->prepare('DELETE FROM inventory WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = 0;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}

		else {
			$response = $Cnn->prepare('UPDATE inventory SET quantity=:newQuantity WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('newQuantity' => ($data[0] - 1),'itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = $data[0] - 1;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}
	}

	else if ($func == 7) {
		$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:itemId AND userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		$data = $response->fetch();

		if ($data[0] == 1) {
			$response = $Cnn->prepare('DELETE FROM inventory WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = 0;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}

		else {
			$response = $Cnn->prepare('UPDATE inventory SET quantity=:newQuantity WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('newQuantity' => ($data[0] - 1),'itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = $data[0] - 1;
			echo json_encode(array('returnmsg' => $returnmsg, 'itemName' => $iName, 'itemId' => $itemId));
		}
	}

	else if ($func == 3) {
		$response = $Cnn->prepare('UPDATE user SET equipWeapon=:itemId WHERE userId=:playerId');
		$response->execute(array('itemId' => NULL, 'playerId' => $playerId));
		echo json_encode(array('itemName' => $iName, 'itemId' => $itemId));
	}

	else if ($func == 4) {
		$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:itemId AND userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		$howMuch = $response->fetch();

		$response = $Cnn->prepare('SELECT power FROM items WHERE itemId=:itemId');
		$response->execute(array('itemId' => $itemId));
		$pow = $response->fetch();

		$response = $Cnn->prepare('SELECT userLevel FROM user WHERE userId=:playerId');
		$response->execute(array('playerId' => $playerId));
		$level = $response->fetch();

		$response = $Cnn->prepare('SELECT userHealth FROM user WHERE userId=:playerId');
		$response->execute(array('playerId' => $playerId));
		$health = $response->fetch();

		$max = (150 + 50 * $level[0]);
		$total = ($health[0] + $pow[0]);
		$boost = $pow;

		if ($max < $total) {
			$total = $max;
			$boost = ($max - $health[0]);
		}

		$response = $Cnn->prepare('UPDATE user SET userHealth=:total WHERE userId=:playerId');
		$response->execute(array('total' => $total, 'playerId' => $playerId));

		if ($howMuch[0] == 1) {
			$response = $Cnn->prepare('DELETE FROM inventory WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = 0;
			echo json_encode(array('returnmsg' => $returnmsg, 'boost' => $boost, 'itemId' => $itemId));
		}

		else {
			$response = $Cnn->prepare('UPDATE inventory SET quantity=:newQuantity WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('newQuantity' => ($howMuch[0] - 1),'itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = $howMuch[0] - 1;
			echo json_encode(array('returnmsg' => $returnmsg, 'boost' => $boost, 'itemId' => $itemId));
		}		
	}

	else if ($func == 6) {
		$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:itemId AND userId=:playerId');
		$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
		$howMuch = $response->fetch();

		$response = $Cnn->prepare('SELECT power FROM items WHERE itemId=:itemId');
		$response->execute(array('itemId' => $itemId));
		$pow = $response->fetch();

		$response = $Cnn->prepare('SELECT energy FROM user WHERE userId=:playerId');
		$response->execute(array('playerId' => $playerId));
		$energy = $response->fetch();

		$max = 100;
		$total = ($energy[0] + $pow[0]);
		$boost = $pow[0];

		if ($max < $total) {
			$total = $max;
			$boost = ($max - $energy[0]);
		}

		$response = $Cnn->prepare('UPDATE user SET energy=:total WHERE userId=:playerId');
		$response->execute(array('total' => $total, 'playerId' => $playerId));

		if ($howMuch[0] == 1) {
			$response = $Cnn->prepare('DELETE FROM inventory WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = 0;
			echo json_encode(array('returnmsg' => $returnmsg, 'boost' => $boost, 'itemId' => $itemId));
		}

		else {
			$response = $Cnn->prepare('UPDATE inventory SET quantity=:newQuantity WHERE itemId=:itemId AND userId=:playerId');
			$response->execute(array('newQuantity' => ($howMuch[0] - 1),'itemId' => $itemId, 'playerId' => $playerId));
			$returnmsg = $howMuch[0] - 1;
			echo json_encode(array('returnmsg' => $returnmsg, 'boost' => $boost, 'itemId' => $itemId));
		}		
	}
}
catch (PDOException $erreur)
{        
	echo 'Erreur : '.$erreur->getMessage();
}
?>