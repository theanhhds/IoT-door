<?php
	include("func.php");
	if (isset($_COOKIE["usr"]) && !empty($_COOKIE["usr"]) && verify($_COOKIE["usr"],$_COOKIE["pss"])) 
	{
		header("Location: open.php");
		exit();
	}
?>
<html>
	<head>
		<meta name="theme-color" content="#99ffcc">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
		<link rel="stylesheet" href="style.css">
		<meta charset="UTF-8">
		<title>INNOVATION</title>
	</head>

	<body align='center'>
	<div class = "w3-container">
		<br><br>
		<h1 style="color:red; font-size:250%" class = "title">Door lock</h1> 
		<a href="register.php">Register new account</a>
		<br><br><br><br>
		<form action="login.php" method="post">
			<input placeholder="Username" autofocus type = "text" name="usr" class = "login" autofocus="true" autocomplete="off"><br><br>
			<input placeholder="Password" type = "password" name="pss" class = "login"><br><br>
			<input type = "submit" value = "Log in">
		</form>
		<?php 
			if (isset($_GET["login"]) && !empty($_GET["login"]))
				echo "Something went wrong. Please try again!";
		?>
		<br><br><br><br>
	</div>
	</body>
</html>