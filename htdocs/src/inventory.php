<?php
if(!isset($_SESSION))
		session_start();

require_once "sessionExpire.php";

require_once "connection.php";

$playerId = $_SESSION['ID'];

$response = $Cnn->prepare('SELECT itemId FROM inventory WHERE userId=:playerId');
$response->execute(array('playerId' => $playerId));

$itemIds = array();
while ($d = $response->fetch()) {
	array_push($itemIds, $d['itemId']);
}

$weapons = array();
$healing = array();
$food = array();
for ($i = 0; $i < sizeof($itemIds); $i++) {

	$response = $Cnn->prepare('SELECT typeId FROM items WHERE itemId=:iId');
	$response->execute(array('iId' => $itemIds[$i]));
	$type = $response->fetch();

	$response = $Cnn->prepare('SELECT itemName FROM items WHERE itemId=:iId');
	$response->execute(array('iId' => $itemIds[$i]));
	$data1 = $response->fetch();

	$response = $Cnn->prepare('SELECT power FROM items WHERE itemId=:iId');
	$response->execute(array('iId' => $itemIds[$i]));
	$data2 = $response->fetch();

	$response = $Cnn->prepare('SELECT quantity FROM inventory WHERE itemId=:iId AND userId=:playerId');
	$response->execute(array('iId' => $itemIds[$i], 'playerId' => $playerId));
	$data3 = $response->fetch();

	if ($type[0] == 1) {
		array_push($weapons, array($data1[0], $data2[0], $data3[0], $itemIds[$i]));
	}

	else if ($type[0] == 2) {
		array_push($healing, array($data1[0], $data2[0], $data3[0], $itemIds[$i]));
	}

	else if ($type[0] == 3) {
		array_push($food, array($data1[0], $data2[0], $data3[0], $itemIds[$i]));
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
		<script type="text/javascript" src="js/inventory.js"></script>
	</head>
 	<link type="text/css" href="css/inventory.css" rel="stylesheet" />
	<body>
		<div id="response" name="response"></div>
		<div class="container">
		  <h2>Weapons</h2>
		  <table class="table table-striped table-condensed">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Power</th>
		        <th>Quantity</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<?php foreach ($weapons as $weapon) : ?>
				<tr id='wOption<?php echo $weapon[3]; ?>'>
				<td><?= htmlspecialchars($weapon[0]) ?></td>
				<td><?= htmlspecialchars($weapon[1]) ?></td>
				<td id="wQuant<?php echo $weapon[3]; ?>"><?= htmlspecialchars($weapon[2]) ?></td>
				<td><button class="equipbtn btn-primary" onclick="useObject(<?php echo $playerId ?>,'<?php echo $weapon[3] ?>', 1)">Equip</button></td>
		       	<td><button class="dropbtn btn-danger" onclick="useObject(<?php echo $playerId ?>,'<?php echo $weapon[3] ?>', 2)">Drop</button></td>
		       	<td><button class="unequipbtn btn-warning" onclick="useObject(<?php echo $playerId ?>,'<?php echo $weapon[3] ?>', 3)">Unequip</button></td>
		       	</tr>
				<?php endforeach ?>
		    </tbody>
		  </table>
		</div>
		<div class="container">
		  <h2>Healing</h2>
		  <table class="table table-striped table-condensed">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Health</th>
		        <th>Quantity</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<?php foreach ($healing as $healing) : ?>
				<tr id='hOption<?php echo $healing[3]; ?>'>
				<td><?= htmlspecialchars($healing[0]) ?></td>
				<td><?= htmlspecialchars($healing[1]) ?></td>
				<td id="hQuant<?php echo $healing[3]; ?>"><?= htmlspecialchars($healing[2]) ?></td>
				<td><button class="usebtn btn-primary" onclick="useObject(<?php echo $playerId ?>,'<?php echo $healing[3] ?>', 4)">Use</button></td>
		       	<td><button class="dropbtn btn-danger" onclick="useObject(<?php echo $playerId ?>,'<?php echo $healing[3] ?>', 5)">Drop</button></td>
		       	</tr>
				<?php endforeach ?>
		    </tbody>
		  </table>
		</div>
		<div class="container">
		  <h2>Food</h2>
		  <table class="table table-striped table-condensed">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Energy</th>
		        <th>Quantity</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<?php foreach ($food as $food) : ?>
				<tr id='fOption<?php echo $food[3]; ?>'>
				<td><?= htmlspecialchars($food[0]) ?></td>
				<td><?= htmlspecialchars($food[1]) ?></td>
				<td id="fQuant<?php echo $food[3]; ?>"><?= htmlspecialchars($food[2]) ?></td>
				<td><button class="usebtn btn-primary" onclick="useObject(<?php echo $playerId ?>,'<?php echo $food[3] ?>', 6)">Use</button></td>
		       	<td><button class="dropbtn btn-danger" onclick="useObject(<?php echo $playerId ?>,'<?php echo $food[3] ?>', 7)">Drop</button></td>
		       	</tr>
				<?php endforeach ?>
		    </tbody>
		  </table>
		</div>
		<div class="alert alert-success" id="equip-alert">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <strong>Equipped! </strong>
		    Weapon has been equipped
		</div>
		<div class="alert alert-success" id="drop-alert">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <strong>Dropped! </strong>
		    You've dropped the item
		</div>
		<div class="alert alert-success" id="unequip-alert">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <strong>Removed! </strong>
		    Weapon has been unequipped
		</div>
		<div class="alert alert-success" id="use-alert">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <strong>Used! </strong>
		    Item has been used
		</div>
	</body>
</html>
	