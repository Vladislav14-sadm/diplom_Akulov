<?php
echo '<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	
	<link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="header">
	<script src="../js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		  <div class="container-xl">
			
			<span class="navbar-brand"><img src="../img/logo_white.png" alt="Логотип"></span>
			<span class="navbar-brand" href="#">Городская поликлинника №24</span>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Заявки
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="../php/admin-panel.php">Все</a></li>
					<li><a class="dropdown-item" href="../php/admin-panel.php?vxod=Входящий">Входящие</a></li>
					<li><a class="dropdown-item" href="../php/admin-panel.php?inwork=В работе">В работе</a></li>
					<li><a class="dropdown-item" href="../php/admin-panel.php?done=Выполнен">Выполненные</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">Избранные</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="../php/admin-panel.php?done=Отклонен">Отклоненные</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="application.php">Добавить заявку</a></li>
				  </ul>
				</li>		
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Пользователи
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="../php/users.php">Все пользователи</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="../php/new_user.php">Добавить Пользователя</a></li>
				  </ul>
				</li>
				
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Отдел
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="../php/department.php">Посмотреть на все отделы</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="../php/new_department.php">Добавить отдел</a></li>
				  </ul>
				</li>
				
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Устройства
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="../php/device.php">Все устройства</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="../php/new_device.php">Добавить устройство</a></li>
				  </ul>
				</li>
				
								
			  </ul>
			  <a href="logout.php" ><button class="btn btn-secondary" type="submit">Выход</button></a>
			</div>
		  </div>
		</nav>
</body>
</html></li>';
?>