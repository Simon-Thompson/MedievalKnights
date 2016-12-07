<?php
if(!isset($_SESSION))
		session_start();

//require_once "sessionExpire.php";

require_once "connection.php";

$playerId = $_SESSION['ID'];

$response = $Cnn->prepare('SELECT userId FROM user WHERE userId!=:playerId');
$response->execute(array('playerId' => $playerId));

$players = array();
while ($d = $response->fetch()) {
	array_push($players, $d[0]);
}

$playerArray = array();
for ($i = 0; $i < sizeof($players); $i++) {

	$response = $Cnn->prepare('SELECT userName FROM user WHERE userId=:userId');
	$response->execute(array('userId' => $players[$i]));
	$name = $response->fetch();

	$response = $Cnn->prepare('SELECT userLevel FROM user WHERE userId=:userId');
	$response->execute(array('userId' => $players[$i]));
	$level = $response->fetch();

	$response = $Cnn->prepare('SELECT userHealth FROM user WHERE userId=:userId');
	$response->execute(array('userId' => $players[$i]));
	$health = $response->fetch();

	array_push($playerArray, array($name[0], $level[0], $health[0], $players[$i]));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
	</head>
 	<link type="text/css" href="css/inventory.css" rel="stylesheet" />
	<body>
		<div id="response" name="response"></div>
		<div class="container">
		  <h2>Choose Player to Attack</h2>
		  <table class="table table-striped table-condensed">
		    <thead>
		      <tr>
		        <th>Player</th>
		        <th>Level</th>
		        <th>Health</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<?php foreach ($playerArray as $player) : ?>
				<tr>
				<td><?= htmlspecialchars($player[0]) ?></td>
				<td><?= htmlspecialchars($player[1]) ?></td>
				<td><?= htmlspecialchars($player[2]) ?></td>
				<td><button class="btn-primary" onclick="loadAttack(<?php echo $player[3] ?>)">Attack</button></td>
		       	</tr>
				<?php endforeach ?>
		    </tbody>
		  </table>
		</div>
	</body>
</html>
	