<?php
header('Content-Type: text/html; charset=utf-8');

require_once "../connection/connection.php";

	$login = $_POST['login'];
	$password = $_POST['password'];
	$select_user = "SELECT * FROM employee WHERE login='$login' AND password='$password'";
	$result= queryMysql($select_user);
	$rows = $result->num_rows;

	
	if ($rows > 0){
		
		//$user = mysqli_fetch_assoc($result);
		$row = $result->fetch_assoc();
		$FIO = $row['FIO'];
		$id_depart = $row['id_department'];
		$rights= $row ['rights'];
		
		$select_depart = "SELECT name FROM department WHERE id_department='$id_depart'";
		$result= queryMysql($select_depart);
		$row = $result->fetch_assoc();
		$depart = $row['name'];
		
		
		setcookie("login", $login, time()+9600, '/', 'localhost', false);
		setcookie("password", $password, time()+9600, '/', 'localhost', false);
		setcookie("FIO", $FIO, time()+9600);
		setcookie("depart", $depart, time()+9600);
		setcookie("rights", $rights, time()+9600);
		
		if ($rights > 1){
		header('Location:../php/admin-panel.php');
		}else{
		header('Location:../php/applic.php');}
		//cooki
		
	

	}else {
	echo '<h3 align="center" style="margin-top:20%">Неверный логин или пароль <br><br> <a href="../index.php">Назад</a></h3>';
	}

?>