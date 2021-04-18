<?php 
	if (!isset($_COOKIE['login'])) {
	header('Location:../index.php');}
	
	$rights_d = $_COOKIE['rights'];
	if ($rights_d < 2) {
	header('Location:application.php');}
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<?php include "../html/header.php"; 
		//подключение к БД
		require_once "../connection/connection.php";?>
	
	<div class="container">
		<div class="new_user">
			<h3>Добавить пользователя </h3>
			
			<div class="mb-3">
			
			<form method="post" action="new_user.php">
				<label for="exampleFormControlInput1" class="form-label">ФИО: </label>
			  <input type="text" name="FIO" class="form-control" placeholder="Иванов Петр Васильевич" required>
			
			  <label for="exampleFormControlInput1" class="form-label">Логин: </label>
			  <input type="text" name="login" class="form-control" placeholder="ivanov" required>		
			 
			  <label for="exampleFormControlInput1" class="form-label">Пароль: </label>
			  <input type="text" name="passw" class="form-control" placeholder="petr1602" required>

			  <label for="exampleFormControlInput1" class="form-label">Права доступа: </label>
			<select name="right" class="form-select" aria-label="Default select example">
				<option>Пользователь</option>
				<option>Администратор</option>
				<option>Помощник администратора</option>
			  </select>
			  
			  <label for="exampleFormControlInput1" class="form-label">Отдел: </label>
			<select name="department" class="form-select" aria-label="Default select example">
				 
				 <?php 
			  
			  $select_depart = "SELECT name FROM department";
			  $result_depart= queryMysql($select_depart);
			  $rows = $result_depart->num_rows;

			  for ($i = 0 ; $i < $rows ; ++$i){
				  
				  $row = $result_depart->fetch_assoc();
				  echo '<option>'.  $row['name'] . '</option>';
				}		 
			  ?>
			  
			  </select>
			  </div>
			  <div class="mb-3">
			  <button type="submit" class="btn btn-primary mb-3">Добавить</button>
			  </form>
			</div>

		<?php 
		
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{
			
			$login = trim($_POST['login']);
			$FIO = trim($_POST['FIO']);
			$passw = trim($_POST['passw']);
			$right = $_POST['right'];
			
			 if (empty($FIO) && empty($login) && empty($passw) && empty($right)){
            
		 }else{
			$select_login = "select id_employee from employee where login = '$login'";
			$result_login = queryMysql($select_login);
			$rows_login = $result_login->num_rows;
			
			if ($rows_login > 0)
			{
				echo 'Логин занят, используйте другой';
			}else{
			

			switch ($right) {
			case "Пользователь":
				$right = 1;;
				break;
			case "Администратор":
				$right = 3;;
				break;
			case "Помощник администратора":
				$right = 2;
				break;
			}
			
			$department = $_POST['department'];
			$select_depart = "select id_department from department where name = '$department'";
			$result_depart = queryMysql($select_depart);
			$row = $result_depart->fetch_assoc();
			$id_depart = $row['id_department'];


			$insert_new_user="Insert into employee (FIO, login, password, rights, id_department) Values ('$FIO', '$login','$passw', '$right', '$id_depart')"; 	
			$result_new_user = queryMysql($insert_new_user);
			
			echo 'Пользователь успешно добавлен';
			}
		  }	
		 }?>
		
		</div>
	</div>		
		  
			 
			

	<?php include "../html/footer.html"; ?>
</body>
</html>