<?php
require_once "connection.php";
$response = $Cnn->prepare('SELECT itemId FROM items');
$response->execute();
$items = array();
$items['itemId'] = $response->fetchAll(PDO::FETCH_COLUMN);
$response = $Cnn->prepare('SELECT itemName FROM items');
$response->execute();
$items['itemName'] = $response->fetchAll(PDO::FETCH_COLUMN);
$response = $Cnn->prepare('SELECT chance FROM items');
$response->execute();
$items['chance'] = $response->fetchAll(PDO::FETCH_COLUMN);

$key = getRandomWeightedElement($items['chance']);

$playerId = $_POST["playerId"];

$response = $Cnn->prepare('SELECT userId, itemId, quantity FROM inventory WHERE itemId='.$items['itemId'][$key].' AND userId='.$playerId);
$response->execute();
$inven = $response->fetch();
if($inven == null){
	$quantity = 1;
	$sql = 'INSERT INTO inventory (userId,itemId,quantity) VALUES ('.$playerId.','.$items['itemId'][$key].','.$quantity.')';
	$Cnn->exec($sql);
}
else {
	$quantity = $inven['quantity']+1;
	$sql = 'UPDATE inventory SET quantity='.$quantity.' WHERE itemId='.$items['itemId'][$key].' AND userId='.$playerId;
	$Cnn->exec($sql);
}



$html = '<div class="alert alert-success" id="explore-alert">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <strong>Item Found! </strong>
		    You found '.$items['itemName'][$key].'
		</div>';

echo $html;


  function getRandomWeightedElement(array $weightedValues) {
    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
  }

?>