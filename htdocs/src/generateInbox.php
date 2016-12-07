<?php
	$response = $Cnn->prepare('SELECT mailId, userId, userName, mailDate, mailMessage FROM mails inner join user on user.userId = mails.mailSenderId WHERE mailReceiverId=:playerId ORDER BY mailDate DESC');
	$response->execute(array('playerId' => $playerId));
	$data = $response->fetch();
	
	echo "<table class='table table-striped table-condensed'>
			<tr>
				<td>From</td>
				<td>Messages</td>
			</tr>";
	
	if ($data == NULL) {
		echo "
		<tr>
			<td></td>
			<td>No messages</td>
		</tr>
		";
	}
	else{
		do{
			echo "
			<tr>
				<td>" . $data['userName'] . "[" . $data['userId'] . "]</td>
				<td></td>
			</tr>
			<tr>
				<td>" . $data['mailDate'] . "</br> <a href='#'>Reply</a> </br> <a href='#' onclick='removeMail(". $data['mailId'] ."," . $playerId . ")'>Remove</a></td>
				<td>" . $data['mailMessage'] . "</td>
			</tr>
			";
		}while($data = $response->fetch());
	}
	
	echo "</table>";
	
?>