<?php
if (isset($_COOKIE['login'])) {
header('Location: php/application.php');
}
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/style.css" rel="stylesheet">
	<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
	
</head>
<body>

	<div class="container-sm">
		<div class="login-page">
			  <div class="form">
				<!--<form method="post" class="register-form" action="connection/registration.php">
				  <input type="text" name="FIO" value="" placeholder="ФИО" required>
				  <input type="text" name="login_regis" value="" placeholder="Логин" required>
				  
				  <div class="password">
				  <input type="password" id="password-regis" name="password_regis" placeholder="Пароль" required>
				  <a href="#" class="password-control">Показать пароль</a>
				  </div>
				  
				  <input type="text" name="depart" value="Терапия" placeholder="Отдел" required>

				  <button>Зарегистрироваться</button>
				  <p class="message">Уже есть профиль?<a href="#">Войти</a></p>
				</form>-->
				
				<form class="login-form" method="post" action="php/login.php">
				  <input type="text" name="login" value="" placeholder="Логин" required>
				  
				  <div class="password">
				  <input type="password" id="password-input" name="password" placeholder="Пароль" required>
				  <a href="#" class="password-control">Показать пароль</a>
				  </div>
				  <button>Войти</button>
				  <p class="message">Нет аккаунта? <a href="#">Войти как гость</a></p>
				</form>
			  </div>	
			</div>
	</div>
	
	<script src="js/script.js"></script>
<script>
	
</script>
</body>
</html>
