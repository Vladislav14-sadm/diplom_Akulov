<!DOCTYPE html>
<html lang='ru'>
<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<div class="main-login">
	
			<div class="login-page">
			  <div class="form">

				<form class="login-form" method="post" action="connection/login.php">
				  <input type="text" name="FIO" value="" placeholder="ФИО" required>
				  <input type="text" name="login" value="" placeholder="Логин" required>
				  <input type="password" name="password" placeholder="Пароль" required>
				 
				 <select>
					  <option>Хирург</option>
					  <option>Терапевт</option>
				  </select>
				  
				  <button>Войти</button>
				  <p class="message">Уже зарегистрированы? <a href="../index.php">Войти</a></p>
				</form>
			  </div>	
			</div>

	</div>
	
</body>
</html>