<?php
	include("func.php");
	if (empty($_POST["usr"]) || empty($_POST["pss"]))
	{
		header("Location: index.php?login=false");
	}
	$dir = "./data/users/".$_POST["usr"]."/";
	if (file_exists($dir) && is_dir($dir))
	{
		if (verify($_POST["usr"],$_POST["pss"]))
		{
			$cookie_name = "usr";
			$cookie_value = $_POST["usr"];
			setcookie($cookie_name, $cookie_value, time()+86400, "/");		//Set cookie here
			setcookie("pss", $_POST["pss"], time()+86400, "/");
			//echo "Login succesfully!";
			header("Location: open.php?login=true");								//Redirect to play.php
			exit();
		}
		else
		{
			header("Location: index.php?login=false");
			//echo "Username or password is not correct. Please try again. Click <a href='index.php'>here";
		}
	}
	else
	{
		header("Location: index.php?login=false");
	}
?>