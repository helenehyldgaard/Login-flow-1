<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
    <link href="login.css" rel="Stylesheet">
</head>

<body>
<?php
if (filter_input(INPUT_POST, 'submit')){
	
	$un = filter_input(INPUT_POST, 'un')
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	require_once('dbcon.php');
	$sql = 'SELECT id, password FROM login WHERE user=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($id, $kodeord);
	
	while($stmt->fetch()) {  }
	
	if (password_verify($pw, $kodeord)){
		echo 'Logged in as '.$un;
		$_SESSION['uid'] = $id;
		$_SESSION['username'] = $un;
	}
	else {
		echo 'Illegal username/password combination';
	}
}
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input name="un" type="text"     placeholder="Brugernavn" required /><br>
    	<input name="pw" type="password" placeholder="Password"   required /><br>
    	<input name="submit" type="submit" value="Login" />
	</fieldset>
</form>
<p>
</body>
</html>
