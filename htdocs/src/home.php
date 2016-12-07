<?php
if(!isset($_SESSION))
		session_start();

require_once "sessionExpire.php";

require_once "connection.php";

$playerId = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
	</head>
	<body>
		<div>
			Username: <?php 
						$reponse = $Cnn->prepare('SELECT userName FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Level: <?php 
						$reponse = $Cnn->prepare('SELECT userLevel FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Health: <?php 
						$reponse = $Cnn->prepare('SELECT userHealth FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Attack: <?php 
						$reponse = $Cnn->prepare('SELECT attack FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Defense: <?php 
						$reponse = $Cnn->prepare('SELECT defence FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Speed: <?php 
						$reponse = $Cnn->prepare('SELECT speed FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Energy: <?php 
						$reponse = $Cnn->prepare('SELECT energy FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Will: <?php 
						$reponse = $Cnn->prepare('SELECT will FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();
						echo $data[0];
					?>
		</div>
		<div>
			Current Equipped Weapon: <?php 
						$reponse = $Cnn->prepare('SELECT equipWeapon FROM user WHERE userId=:userId');
						$reponse->execute(array('userId' => $playerId));
						$data = $reponse->fetch();

						$reponse = $Cnn->prepare('SELECT itemName FROM items WHERE itemId=:itemId');
						$reponse->execute(array('itemId' => $data[0]));
						$data = $reponse->fetch();						
						echo $data[0];
					?>
		</div>
	</body>	
</html>
