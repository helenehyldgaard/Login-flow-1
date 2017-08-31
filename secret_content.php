
<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
Dette kan alle se...
<hr>
<?php
	if(empty($_SESSION['uid'])) {
		echo 'Not logged in!!!!';
	}
	else {
		echo 'Welcome to the conten Dr. '.$_SESSION['username'].'<br>';
		echo 'Here be stuff for logged in users only....';
	}
?>
</body>
</html>