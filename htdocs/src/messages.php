<?php
if(!isset($_SESSION))
		session_start();

require_once "sessionExpire.php";

$playerId = $_SESSION['ID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<!--<link rel="stylesheet" href="css/StyleEtoile.css"> example for css sheet -->
		<title>Message</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			function isValid(str) { 
				return /^\w+$/.test(str); 
			}

			function msgValid(str) {
				return /^[a-zA-Z\s]*$/.test(str);
			}

			function check() {
				var g2g = true;
				var user = document.getElementById('uname').value;
				var msg = document.getElementById('msg').value;
				var userAlert = document.getElementById('uAlert');
				var msgAlert = document.getElementById('msgAlert');

				if (user.length < 3 || user.length > 16){
					userAlert.innerHTML = "Please input a username between 3 and 16 characters long";
					g2g = false;
				}
				else if (!isValid(user)){
					userAlert.innerHTML = "Please input a username with only letters, numbers, and underscores";
					g2g = false;
				}
				else { userAlert.innerHTML = ""; }

				if (!msgValid(msg)){
					msgAlert.innerHTML = "Please input a message with only letters and spaces";
					g2g = false;
				}
				else { msgAlert.innerHTML = ""; }
				
				
				if(g2g) { sendMail(); }
			}

			function sendMail(){
				var serializedData = $( "#myForm" ).serialize();
				$.ajax({
				type: "post",
				data: serializedData,
				url: 'src/sendMsg.php',
				success: function(response) {
					var json = $.parseJSON(response);
					$("#response").css('color', 'black');
					$( "#response" ).html(json.returnmsg);
					document.getElementById('replace').innerHTML = json.returnmsg;
				},
				error: function(response) {
					$("#response").css('color', 'red');
					$("#response").html(response);
				  }
				});
			}		
		</script>
	</head>
	<body>
		<div id="replace">
			<form id="myForm" method="post" action="sendMsg.php">
				<input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>">
				<div id="response" name="response"></div>
				
				<input class="form-control" type="text" placeholder="Username" name="uname" id="uname">
				<div style="color:red" id="uAlert"></div><br/>
		 		<textarea class="form-control" rows="4" cols="50" name="msg" id="msg"></textarea>
				<div style="color:red" id="msgAlert"></div><br/>
				<button type="reset" class="btn-warning">Cancel</button>
		    	<button type="button" class="btn-primary" onclick="check()">Send Message</button>
		    	<br/>
			</form>
		</div>
	</body>	
</html>
