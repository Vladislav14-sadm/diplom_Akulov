<?php
	if (isset($_COOKIE['login'])){
		setcookie("login", $login, time()-3600,'/', 'localhost', false);
		setcookie("password", $password, time()-3600,'/', 'localhost', false);
		setcookie("FIO", $FIO, time()-3600);
		setcookie("depart", $depart, time()-3600);
	}
	
	header('Location:../index.php');
?>