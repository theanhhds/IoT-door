<?php 
	if (isset($_COOKIE['usr'])) {
    unset($_COOKIE['usr']);
    setcookie('usr', '', time() - 3600, '/');
	unset($_COOKIE['pss']);
    setcookie('pss', '', time() - 3600, '/');
	header("Location: index.php");
	die();
}
?>