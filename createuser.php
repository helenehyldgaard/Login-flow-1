<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
if (filter_input(INPUT_POST, 'submit')){
	
	$un = filter_input(INPUT_POST, 'un')
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	$pw = password_hash($pw, PASSWORD_DEFAULT);
	
	echo 'Creating user '.$un.' with password: '.$pw;
	
	require_once('dbcon.php');
	$sql = 'INSERT INTO login (user, password) VALUES (?, ?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute();
	
	if ($stmt->affected_rows > 0){
		echo 'user '.$un.' added ';
	}
	else {
		echo 'Could not add the user.';
	}
}
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Create user</legend>
    	<input name="un" type="text"     placeholder="Brugernavn" required /><br>
    	<input name="pw" type="password" placeholder="Password"   required /><br>
    	<input name="submit" type="submit" value="Opret bruger" />
	</fieldset>
</form>
<p>
</body>
</html>