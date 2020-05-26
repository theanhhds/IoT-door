<?php
	include("func.php");
    $f = fopen("./data/mk.txt", "r");
    $p = fgets($f);
    fclose($f);
	if (!isset($_POST["adpss"]) || !password_verify($_POST["adpss"], $p))
	{
		echo "Admin password is wrong. Please try again<br>";
		echo "Click <a href='register.php'>here</a> to go back.";
		exit();
	}
	$dir = "./data/users/".$_POST["usr"];
	if (!file_exists($dir))
	{
		mkdir($dir, 0711, true);
		$f = fopen($dir."/info.txt", "w");
		fwrite($f, password_hash($_POST["pss"], PASSWORD_DEFAULT));
		fclose($f);
		echo "User has been created. Click <a href='index.php'>here</a> to log in";
	}
	else
		echo "This username has been taken, please choose another! Click <a href = 'register.php'>here</a> to go back";
?>
