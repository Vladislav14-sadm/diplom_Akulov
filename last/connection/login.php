<?php
header('Content-Type: text/html; charset=utf-8');

//временное подключение
$dbhost = 'localhost'; // Эта строка вряд ли нуждается в изменении
$dbname = 'application'; // А значения этих переменных
$dbuser = 'root'; // поменяйте на те, что соответствуют
$dbpass = 'root'; // вашим настройкам

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);

function queryMysql($query)
	{
		global $connection;
		$result = $connection->query($query);
		
		if (!$result) die($connection->error);
		return $result;
	}


	$login = $_POST['login'];
	$password = $_POST['password'];
	$select_user = "SELECT * FROM employee WHERE login='$login' AND password='$password'";
	$result= queryMysql($select_user);
	$rows = $result->num_rows;
	
	if ($rows > 0){
		
		$user = mysqli_fetch_assoc($result);
		header('Location:../php/application.php');

	}else {
	echo '<p align="center" style="margin-top:20%">Неверный логин или пароль <br><br> <a href="../index.php">Назад</a></p>';
	}

?>