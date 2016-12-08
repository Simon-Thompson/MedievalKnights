<?php

if(!isset($_SESSION))
		session_start();
$playerId = $_SESSION['ID'];

if (isset($_GET['Id'])) 
	$opponentId = htmlentities($_GET['Id']);
else
	echo "Who are you trying to attack?";

require_once "connection.php";
try
{
	$reponse = $Cnn->prepare('SELECT userId, userName, userLevel, userHealth, itemName FROM user LEFT JOIN items on user.equipWeapon = items.itemId WHERE userId=:userId');
	$reponse->execute(array('userId' => $playerId));
	if(($playerStat = $reponse->fetch())== null)
		echo "user does not exist";
	
	$reponse = $Cnn->prepare('SELECT userId, userName, userLevel, userHealth, itemName FROM user LEFT JOIN items on user.equipWeapon = items.itemId WHERE userId=:userId');
	$reponse->execute(array('userId' => $opponentId));
	if(($opponentStats = $reponse->fetch())== null)
		echo "user does not exist";
	
}
catch(PDOExeption $erreur)
{
	echo 'Erreur: ' .$erreur->getMesssage();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
		<title>Attack</title>
		<script type="text/javascript" charset="utf-8">
			function attackOpp(){
				var serializedData = $( "#myForm" ).serialize();
				$.ajax({
				type: "post",
				data: serializedData,
				url: 'src/damageCalculator.php',
				success: function(response) {
					var json = $.parseJSON(response);
					$("#playerD").html(json.playerD);
					if(json.oppD == 0){
						$("#oppD").html('');
						$("#divBigTable").hide();
						$("#victory").css('display', 'block');
						
					}
					else{
						$("#oppD").html(json.oppD);
						if(json.playerH == 0){
							$("#divBigTable").hide();
							$("#defeat").css('display', 'block');
						}
						else{
							$("#playerHealth").html(json.playerH);
							$("#opponentHealth").html(json.oppH);
						}
						
					}
						
					
				},
				error: function(response) {
					alert(response);
				  }
				});
			}
		</script>
		<style>
			.divTable
			{
				width: 100%;
				height: 25%;
				display: table;
			}

			.divTableRow
			{
				width: 100%;
				height: 50%;
				display: table-row;
			}

			.divTableCellRight
			{
				width: 50%;
				height: 50%;
				display: table-cell;
				text-align: right;
			}
			.divTableCellLeft
			{
				width: 50%;
				height: 50%;
				display: table-cell;
				text-align: left;
			}
			
			.divTableTitle
			{
				width: 100%;
				height: 5%;
				display: table;
				margin-bottom: 2.5%;
				
			}

			.divTableRowTitle
			{
				width: 100%;
				height: 50%;
				display: table-row;
			}
			
			.divTableCellTitle
			{
				width: 100%;
				height: 50%;
				display: table-cell;
				text-align: center;
			}
			
			.divBigTable
			{
				width: 100%;
				height: 50%;
				display: table;
				margin-left: auto;
				margin-right: auto;
				
			}

			.divBigTableRow
			{
				width: 100%;
				height: 50%;
				display: table-row;
			}
			
			.divBigTableCell
			{
				width: 50%;
				height: 50%;
				display: table-cell;
			}
			
			.buttonSubmit
			{
				margin-left: 2%;
			}
			
			form
			{
				margin: 0;
				padding: 0;
			}
		</style>
	</head>
	<body style="">
	
		<form method="post" id="myForm" name="myForm" action="damageCalculator.php">
		<input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>">
		<input type="hidden" name="oppId" id="oppId" value="<?php echo $opponentId; ?>">
		
		<center style='color: blue;' id="playerD"></center>
		<center style='color: red;' id="oppD"></center>
		
			<div id="divBigTable">
			
				<table class="table table-striped table-condensed">
					
					<tr>
					
						<td>
						
							<table class="table table-striped table-condensed">
								
								<tr>
					
									<td colspan="2">
										<?php
											echo "You: " . $playerStat["userName"] . " [" . $playerStat['userId'] . "] <br>Level: " . $playerStat['userLevel'];
										?>
									</td>
								</tr>
								<tr>
								
									<td colspan="2">
										<?php
											echo "Health: <label id='playerHealth'>" . $playerStat["userHealth"] . "</label>/" . (150 + 50 * $playerStat['userLevel']);
										?>
									</td>
									
								</tr>
									
								<tr>
								
									<td>
										Weapon: &nbsp
									</td>
									
									<td>
										 <?php
											echo ($playerStat["itemName"] == null? 'Fists' :  $playerStat["itemName"]);
										?>
									</td>
									
								</tr>
								
								
							</table>
						
						</td>
					
						<td>
						
							<table class="table table-striped table-condensed">
						
								<tr>
								
									<td colspan="2">
										<?php
											echo "Opponent: " . $opponentStats["userName"] . " [" . $opponentStats['userId'] . "] <br>Level: " . $opponentStats['userLevel'];
										?>
									</td>
									
								</tr>
								
								<tr>
								
									<td colspan="2">
										<?php
											echo "Health: <label id='opponentHealth'>" . $opponentStats["userHealth"] . "</label>/" . (150 + 50 * $opponentStats['userLevel']);
										?>
									</td>
									
								</tr>
										
								<tr>
								
									<td>
										Weapon: &nbsp
									</td>
									
									<td>
										<?php
											echo ($opponentStats["itemName"] == null? 'Fists' :  $opponentStats["itemName"]);
										?>
									</td>
									
								</tr>
							
								<tr>
									
									<td colspan="2"	align="center">
										<button type="button" onclick="attackOpp();" class="buttonSubmit btn-primary">Attack!</button>
									</td>
									
								</tr>
							
							</table>
						
						</td>
						
					<tr>
					
				</table>
			</div>
			
			<div id="victory" style="display:none;">
				<center>You Won!!!!!</center>
				<center><button class="btn-primary" type="button" onclick="redirectHome(<?php echo $playerId; ?>, <?php echo $opponentId; ?>);" class="buttonSubmit">Leave</button></center>
			</div>
			
			<div id="defeat" style="display:none;">
				<center style='color: red;'><?php echo $opponentStats["userName"]; ?>  defeated you </center>
				<center><button class="btn-danger" type="button" onclick="redirectHome(-1, -1);" class="buttonSubmit">Leave</button></center>
			</div>
			
		</form>
		
	</body>
	
</html>
