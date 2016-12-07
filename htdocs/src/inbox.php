<?php
if(!isset($_SESSION))
		session_start();

$playerId = $_SESSION['ID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
		<title>Inbox</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" charset="utf-8">
		function removeMail(mailId, playerId){
				
				$.ajax({
				type: "post",
				data: {"mailId": mailId, "playerId": playerId},
				url: 'deleteMessage.php',
				success: function(response) {
					$("#inbox").html(response);
				},
				error: function(response) {
					
				  }
				});
			}
		</script>
	</head>
	<body>
		<div id="inbox" name="inbox">
			<?php
				require_once "connection.php";
				
				try{
					require_once "generateInbox.php";
					
				}
				catch (PDOException $erreur)
				{        
					echo 'Erreur : '.$erreur->getMessage();
				}
			?>
		</div>
	</body>	
</html>
