<?php
	$f = fopen("log.txt", "a");
	fwrite($f, $_POST["name"]." || ".date("j F Y G:i:s")."\r\n");
	fclose($f);
?>