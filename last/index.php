<!DOCTYPE html>
<html lang='ru'>
<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">

	
</head>
<body>
<!-- когда пользователь будет выходить
<script language="JavaScript">
    alert("Привет, мир!");
</script>-->

	<div class="main-login">
	<!--	<h3>Вход</h3><br>
		<form method="post" action="connection/login.php" >
			    
				<table align="center">
					<tr>
						<td>Логин:</td><td><input type="text" name="login" value="" required></td>
					</tr>
					<tr>
						<td>Пароль:</td><td><input type="password" name="password" required></td>
					</tr>
					<tr> 
						<td colspan="2"><input type="submit" value="Войти"></td>
					</tr>
				</table>
			</form>
			<a href="php/register.php">Регистарция</a><br>
			<br>
			<br>
			<br>-->

			<div class="login-page">
			  <div class="form">
				<form method="post" class="register-form">
				  <input type="text" name="FIO" value="" placeholder="ФИО" required>
				  <input type="text" name="login_regis" value="" placeholder="Логин" required>
				  
				  <div class="password">
				  <input type="password" id="password-input" name="password_regis" placeholder="Пароль" required>
				  <a href="#" class="password-control">Показать пароль</a>
				  </div>
				  
				  <input type="text" name="depart" value="" placeholder="Отдел" required>
				 <!-- <select name="depart">
					  <option>Хирургия</option>
					  <option>Терапия</option>
				  </select>-->
				  <button>Зарегистрироваться</button>
				  <p class="message">Уже есть профиль?<a href="#">Войти</a></p>
				</form>
				
				<form class="login-form" method="post" action="connection/login.php">
				  <input type="text" name="login" value="" placeholder="Логин" required>
				  
				  <div class="password">
				  <input type="password" id="password-input" name="password" placeholder="Пароль" required>
				  </div>
				   <a href="#" class="password-control">Показать пароль</a>
				  
				  
				  
				  <button>Войти</button>
				  <p class="message">Нет аккаунта? <a href="#">Зарегистрироваться</a></p>
				</form>
			  </div>	
			</div>
	</div>
	
	
	<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script>
$('body').on('click', '.password-control', function(){
	if ($('#password-input').attr('type') == 'password'){
		$(this).html('Скрыть пароль');
		$('#password-input').attr('type', 'text');
	} else {
		$(this).html('Показать пароль');
		$('#password-input').attr('type', 'password');
	}
	return false;
}); 

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
	
<?php
require_once "connection/connection.php";
$conn = new mysqli($dbhost, $dbname, $dbuser, $dbpass);
if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
else{
	
	$select_db = mysqli_select_db ($link, $db);
	
	$FIO = $_POST['FIO'];
	$login = $_POST['login_regis']; 
	$password = $_POST['password_regis'];
	$depart = $_POST['depart'];

 $query = "INSERT INTO employee (FIO, login, password, rights, id_departament) VALUES ('$FIO', '$login', '$password', '1', '$depart')";
 $result = $conn->query($query);
}
?>	
</body>
</html>