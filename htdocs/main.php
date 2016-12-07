<?php
	if(!isset($_SESSION))
		session_start();
?>
<html>
<div id="mySidenav" class="sidenav">
	  <a href="#" id="inventory" onclick="loadInnerHTML(this)">Inventory</a>
	  <a href="#" id="explore" onclick="loadInnerHTML(this)">Explore</a>
	  <a href="#" id="training" onclick="loadInnerHTML(this)">Training</a>
	  <a href="#" id="pvp" onclick="loadInnerHTML(this)">PvP</a>
	</div>
<div id="main">
	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link type="text/css" href="css/mainstyle.css" rel="stylesheet" />
		<script type="text/javascript" src="js/main.js"></script>
		<title>Medieval Knights</title>
	</head>

	<ul class="topnav" id="myTopnav">
	  <li><a href="#" id="home" onclick="loadInnerHTML(this)">Home</a></li>
	  <li><a href="#" id="messages" onclick="loadInnerHTML(this)">Messages</a></li>
	  <li><a href="#" id="inbox" onclick="loadInnerHTML(this)">Inbox</a></li>
	  <li><a href="http://localhost/src/logout.php" id="logout">Logout</a></li>
	</ul>
	<body>
		<h1>Medieval Knights</h1>
		<div id="loadContent">
			<p>WELCOME to Medieval Knights!</p>
			<p>Current content is still under construction, play at your own risk.</p>
		</div>
	</body>
</div>

</html>