<?php
if(!isset($_SESSION))
		session_start();

require_once "sessionExpire.php";

require_once "connection.php";
try
{
	$playerId = $_SESSION['ID'];
	$reponse = $Cnn->prepare('SELECT attack, defence, speed, energy, will FROM user WHERE userId=:userId');
	$reponse->execute(array('userId' => $playerId));
	$playerStat = $reponse->fetch();

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
		<title>Training</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			function trainPlayer(){
				
				var serializedData = $( "#myForm" ).serialize();
				$.ajax({
				type: "post",
				data: serializedData,
				url: 'src/calculateStats.php',
				success: function(response) {
					//alert(response);
					var json = $.parseJSON(response);
					var htmlThingy = '<div class="alert alert-success" id="explore-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Trained '+json.stat+'! </strong>You gained '+json.boost+' '+json.stat+'</div>';
					$( "#response" ).html(htmlThingy);
					switch(json.stat) {
						case "attack":
							$("#attackDiv").html(json.currentStat);
							break;
						case "defence":
							$("#defenceDiv").html(json.currentStat);
							break;
						case "speed":
							$("#speedDiv").html(json.currentStat);
							break;
						default:
							
					}

				}
				});
			}
			function disableF5(e) { 
				if ((e.which || e.keyCode) == 116){ e.preventDefault(); trainPlayer() }
			};
				
			$(document).on("keydown", disableF5);
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
		</style>
	</head>
	<body style="">
		<form id="myForm" method="post">
			<input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>">
			<div class="container">
			  <table class="table table-striped table-condensed">
			  	<thead>
			      <tr>
			        <th>Strength</th>
			        <th>Defence</th>
			        <th>Speed</th>
			      </tr>
			    </thead>
			    <tbody>
					<tr>
					<td id="attackDiv"><?php echo $playerStat['attack']; ?></td>
					<td id="defenceDiv"><?php echo $playerStat['defence']; ?></td>
					<td id="speedDiv"><?php echo $playerStat['speed']; ?></td>
			       	</tr>
			    </tbody>
			  </table>
			</div>
			
				
				<div class="divTableRow">
				
					<div class="divTableCellRight">
						<select id="stat" name="stat">
							<option value="attack">Attack</option>
							<option value="defence">Defence</option>
							<option value="speed">Speed</option>
						</select>
						&nbsp
					</div>
					
					<div style="margin:auto">
							<input type="number" name="energy" id="energy" min="1" max="<?php echo $playerStat['energy']; ?>" value="<?php echo $playerStat['energy']; ?>">
							<button type="button" class="btn-primary" onclick="trainPlayer();">Train</button>
					</div>
					
				</div>
				
			</div>
			<div id="response" name="response"></div>
			<?php
				if(isset($boost)){
					echo '<div class="alert alert-success" id="explore-alert">
						    <button type="button" class="close" data-dismiss="alert">x</button>
						    <strong>Trained '.$stat.'! </strong>
						    You gained '.$boost.' '.$stat.'
						</div>';
				}
			?>
		</form>
	</body>
	
</html>
