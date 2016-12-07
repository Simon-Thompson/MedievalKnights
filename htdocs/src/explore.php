<?php
if(!isset($_SESSION))
		session_start();

require_once "sessionExpire.php";

$playerId = $_SESSION['ID'];

$places = array(array("Dark Caverns", "Deep caverns crawling with giant spiders, slugs and bugs"), array("Old Dogwood Wilds", "Dense, warped trees and large plant life obscure sight as catlike predators hunt for prey"), array("Misty Wastes", "Sand and glass mix in a whirlwind of deadly weather conditions, and poisonous creatures wait burrowed under the sands"), array("Wohst Peaks", "Terrifying heights and crumbling cliffsides make up these mountains. Make it to the top, and avian monsters and treasure await"));
?>

<html>
<script type="text/javascript" src="js/explore.js"></script>
 	<link type="text/css" href="css/inventory.css" rel="stylesheet" />
	<body>
		<div class="container">
		  <h2>Locations</h2>
		  <table class="table table-striped table-condensed">
		    <tbody>
		      	<?php foreach ($places as $place) : ?>
				<tr>
				<td><?= htmlspecialchars($place[0]) ?></td>
				<td><?= htmlspecialchars($place[1]) ?></td>
				<td><button class="explorebtn btn-primary" onclick="explore('<?php echo $place[0]?>', <?php echo $playerId ?>)">Explore</button></td>
		       	</tr>
				<?php endforeach ?>
		    </tbody>
		  </table>
		</div>
		<div id="exploreText">
		</div>
	</body>
</html>
	