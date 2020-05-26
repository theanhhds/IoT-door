<?php
	include("func.php");
	if (!(isset($_COOKIE["usr"]) && !empty($_COOKIE["usr"]) && verify($_COOKIE["usr"],$_COOKIE["pss"])))
	{
		echo "You have to log in! Click <a href='index.php'>here</a>";
		exit();
	}
?>
<html>
	<head>
		<title>Smart door open</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
		<link rel="stylesheet" href="style.css">
		<meta name="theme-color" content="#99ffcc">
	</head>
	
	<body align='center'>
	<script>
		function doit() 
		{
			//disable button here
			document.getElementById("but").style="background-color:red";
			document.getElementById("but").style.pointerEvents = 'none';
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange=function() 
			{
				if (this.readyState == 4 && this.status == 200) 
					//enable button here
					{
						document.getElementById("but").style="background-color:green";
						document.getElementById('but').style.pointerEvents = 'auto';
					}
			};
			var url = "https://api.particle.io/v1/devices/40003a001051363036373538/open?access_token=c1d18fb45c6f3176d79cc5cab57aa20f59e9f3d2";
			xhttp.open("POST", url, true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("arg=on");
			//log here
			var xhttp1 = new XMLHttpRequest();
			var url1 = "https://adelie.xyz/iottester/inno/log.php";
			xhttp1.onreadystatechange=function() 
			{
				if (this.readyState == 4 && this.status == 200)
					{console.log("OK")}
			};
			xhttp1.open("POST", url1, true);
			xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp1.send("name=<?php echo $_COOKIE["usr"];?>");
		}
	</script>
	<br>
	<div id="but" class="dot" style="background-color:green" onclick="doit();"></div><br><br><br>
	<a href="./logout.php">Log out</a>
	</body>
</html>
