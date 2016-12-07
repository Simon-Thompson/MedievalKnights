<?php

if (!isset($_SESSION['ID'])) : ?>

<html>
	<body>
		Sorry but your session expired :( <br>
		Please Login again. <br>
		<a href="../src/login">Login Page</a><br>
	</body>
</html>

<?php 
	die();
	endif; 
?>


